<?php

namespace App\Http\Controllers;

use App\Models\Land;
use Illuminate\Http\Request;

class LandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!auth()->user()->farmer) {
            return redirect()->route('farmer.kyc.create')->with('status', 'Please complete KYC before accessing land details.');
        }

        $lands = auth()->user()->farmer->lands;
        return view('farmer.lands.index', compact('lands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!auth()->user()->farmer) {
            return redirect()->route('farmer.kyc.create')->with('status', 'Please complete KYC before registering land.');
        }
        return view('farmer.lands.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'area_in_acres' => 'required|numeric|min:0.01',
            'location_coords' => 'required|string',
            'soil_type' => 'required|string',
            'crop_type' => 'required|string',
            'crops_details' => 'nullable|string',
            'pesticide_usage' => 'nullable|string',
            'insecticide_usage' => 'nullable|string',
        ]);

        auth()->user()->farmer->lands()->create($validated);

        return redirect()->route('dashboard')->with('status', 'Land Details registered successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Land $land)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Land $land)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Land $land)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Land $land)
    {
        //
    }
}
