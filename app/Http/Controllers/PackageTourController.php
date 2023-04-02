<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\PackageTour;
use Illuminate\Http\Request;

class PackageTourController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:tour-package-list|tour-package-create|tour-package-edit|tour-package-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:tour-package-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:tour-package-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:tour-package-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $search = $request->query('search');
        $PackageTour = PackageTour::when($search, function ($query) use ($search) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('phone', 'like', "%{$search}%")
                ->orWhereHas('roles', fn ($query) => $query->where('name', 'like', "%{$search}%"));
        })
            ->paginate(10);
        return view('operator.package-tour.index')->with('PackageTour', $PackageTour);
    }

    public function show($id)
    {
        return view('package-tour-detail');
    }

    public function create()
    {
        return view('operator/package-tour/create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'desc' => 'required',
            'facility' => 'required',
            'route' => 'nullable|string',
            'discount' => 'nullable|numeric|max:100',
            'images' => 'required|array|min:1',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $PackageTour = PackageTour::create($request->only('name', 'desc', 'facility', 'route', 'dicount'));
        $dir = 'package-tour'. $PackageTour->id;
        foreach ($request->file('images') as $image) {
            Image::store($image, $dir, $PackageTour, false);
        }
        return redirect()->route('package-tour.index')->with('success', 'Package Tour created successfully');
    }

    public function storeImage(Request $request, string $id)
    {
        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

            $PackageTour = PackageTour::findOrfail($id);
            $dir = 'package-tour'. $PackageTour->id;
            $image = Image::store($request->file('image'), $dir, $PackageTour, true);
            return redirect()->route('package-tour.edit', $PackageTour->id)->with('success', 'Image uploaded successfully');
    }

    public function destroyImage($id)
    {
        $image = Image::findOrfail($id);
        $image->delete();
        return redirect()->route('package-tour.edit', $image->imageable->id)->with('success', 'Image deleted successfully');
    }

    public function edit($id)
    {
        $packageTour = PackageTour::findOrfail($id);
        foreach ($packageTour->images as $image) {
            $image->url = $image->get();
        }
        return view('operator.package-tour.edit', compact('packageTour'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'desc' => 'required',
            'facility' => 'required',
            'route' => 'nullable|string',
            'dicount' => 'nullable|numeric|max:100',
        ]);

        $PackageTour = PackageTour::findOrfail($id);
        $PackageTour->update([
            'name' => $request->name,
            'desc' => $request->desc,
            'facility' => $request->facility,
            'route' => $request->route,
            'dicount' => $request->dicount,
        ]);
        return redirect()->route('package-tour.index')->with('success', 'Package Tour updated successfully');
    }

    public function destroy($id)
    {

    }

    public function search(Request $request)
    {
        return view('package-tour');
    }


}
