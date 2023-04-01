<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Image;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class EmployeesController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $isSuperadmin = auth()->user()->hasRole('superadmin');
        $users = User::whereHas('roles', function ($query) {
            $query->where('name', '!=', 'customer');
            })
            ->when(! $isSuperadmin, function ($query) {
                $query->whereHas('roles', function ($query) {
                    $query->where('name', '!=', 'superadmin');
                });
            })
            ->when($request->search, function ($query) use ($request, $isSuperadmin) {
                $query->whereHas('roles', function ($query) use ($isSuperadmin) {
                    $isSuperadmin
                        ? $query->whereNot('name', 'customer')
                        : $query->whereNotIn('name', ['superadmin', 'customer']);
                })
                    ->where('name', 'like', "%{$request->search}%")
                    ->orWhere('email', 'like', "%{$request->search}%")
                    ->orWhere('phone', 'like', "%{$request->search}%")
                    ->orWhereHas('roles', function ($query) use ($request) {
                        $query->where('name', 'like', "%{$request->search}%");
                    });
            })->paginate(10);
        return view('admin/employees/employees')->with('users', $users);
    }

    public function show($id)
    {
        $user = User::find($id);
        return view('user.show', compact('user'));
    }

    public function create()
    {
        $isSuperadmin = auth()->user()->hasRole('superadmin');
            $roles = $isSuperadmin
                ? Role::whereNot('name', 'customer')->get()
                : Role::whereNotIn('name', ['superadmin', 'customer'])->get();
        return view('admin/employees/employees-create')->with('roles', $roles);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|max:255|confirmed',
            'role' => 'required|exists:roles,name',
        ]);

        $user = User::create($request->only('name', 'email', 'password'));
        $user->assignRole($request->role);

        return redirect()->route('employees.index')->with('success', 'User created successfully.');
    }

    public function status($id)
    {
        $user = User::find($id);
        $user->update([
            'is_active' => ! $user->is_active]);
        return redirect()->route('employees.index')->with('success', 'User status updated successfully.');

    }

    public function edit($id)
    {
        $isSuperadmin = auth()->user()->hasRole('superadmin');
        $roles = $isSuperadmin
            ? Role::whereNot('name', 'customer')->get()
            : Role::whereNotIn('name', ['superadmin', 'customer'])->get();
        $users = User::where('id', $id)->whereHas('roles', function ($query) {
            $query->whereNot('name', 'customer');
        })->firstOrFail();
        return view('admin/employees/employees-edit', compact('users', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required|exists:roles,name',
            'phone' => 'nullable|numeric|digits_between:10,15',
            'address' => 'nullable|string|min:3',
        ]);

        $employee = User::where('id', $id)->whereHas('roles', function ($query) {
            $query->whereNot('name', 'customer');
        })->firstOrFail();
        $employee->update($request->only('name', 'email', 'phone', 'address'));
        $employee->syncRoles($request->role);

        return redirect()->route('employees.index')->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->route('employees.index')->with('success', 'User deleted successfully.');
    }

    public function Image(Request $request, string $id)
    {
        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

            $user = User::findOrFail($id);
            $dir = 'avatars';
            $image = Image::store($request->file('image'), $dir, $user, true);
            return redirect()->route('employees.edit', $user->id)->with('success', 'Image uploaded successfully');
    }
}
