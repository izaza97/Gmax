<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Image;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;

class UserController extends Controller
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
        $search = $request->query('search');
        $users = User::when(! $isSuperadmin, fn ($query) =>
                $query->whereHas('roles', fn ($query) =>
                    $query->where('name', '!=', 'superadmin')
                )
            )
            ->when($search, function ($query) use ($search, $isSuperadmin) {
                $query->whereHas('roles', fn ($query) => ! $isSuperadmin
                    ? $query->where('name', '!=', 'superadmin')
                    : $query
                )
                ->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('phone', 'like', "%{$search}%")
                ->orWhereHas('roles', fn ($query) => $query->where('name', 'like', "%{$search}%"));
            })
            ->paginate(10);

        return view('admin/users/user-management', compact(['users', 'search']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
            $isSuperadmin = auth()->user()->hasRole('superadmin');
            $roles = $isSuperadmin
                ? Role::all()
                : Role::where('name', '!=', 'superadmin')->get();
            return view('admin/users/user-create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
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
            return redirect()->route('user-management.index')->with('success', 'User created successfully');
    }

    public function storeImage(Request $request, string $id)
    {
        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

            $user = User::findOrFail($id);
            $dir = 'avatars';
            $image = Image::store($request->file('image'), $dir, $user, true);
            return redirect()->route('user.edit', $user->id)->with('success', 'Image uploaded successfully');
    }

    public function destroyImage($id)
    {
            $user = User::findOrFail($id);
            $user->image()->delete();
            return redirect()->route('user.edit', $user->id)->with('success', 'Image deleted successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $user = User::findOrFail($id);
            return view('admin.users.show', compact('user'));
        } catch (\Exception $e) {
            return redirect()->route('users.index')->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
            $user = User::findOrFail($id);
            $isSuperadmin = auth()->user()->hasRole('superadmin');
            $roles = $isSuperadmin
                ? Role::all()
                : Role::where('name', '!=', 'superadmin')->get();
            return view('admin/users/user-edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required|exists:roles,name',
        ]);

            $user = User::findOrFail($id);
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
            $user->syncRoles($request->role);
            return redirect()->route('user-management.index')->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
            $user = User::findOrFail($id);
            $user->delete();
            return redirect()->route('user-management.index')->with('success', 'User deleted successfully');
    }

    public function Status(string $id)
    {
            $user = User::findOrFail($id);
            $user->update([
                'is_active' => ! $user->is_active
            ]);
            return redirect()->route('user-management.index')->with('success', 'User status updated successfully');
    }
}
