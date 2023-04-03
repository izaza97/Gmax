<?php

namespace App\Http\Controllers;

use App\Models\PackageList;
use App\Models\PackageTour;
use Illuminate\Http\Request;

class PackageListController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $packageTour = PackageTour::all();
        $PackageList = PackageList::when($search, function ($query) use ($search) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhereHas('roles', fn ($query) => $query->where('name', 'like', "%{$search}%"));
        })
            ->paginate(10);
        return view('operator.package-list.index')->with('PackageList', $PackageList)->with('packageTour', $packageTour);
    }

    public function create()
    {
        $packageTour = PackageTour::all();
        return view('operator.package-list.create', compact('packageTour'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'package_tour_id' => 'required',
        ]);

        $PackageList = new PackageList();
        $PackageList->name = $request->name;
        $PackageList->quantity = $request->quantity;
        $PackageList->price = $request->price;
        $PackageList->package_tour_id = $request->package_tour_id;
        $PackageList->save();

        return redirect()->route('package-list.index')->with('success', 'Package List created successfully');
    }
}
