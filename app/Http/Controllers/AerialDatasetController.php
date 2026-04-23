<?php

namespace App\Http\Controllers;

use App\Models\AerialDataset;
use Illuminate\Http\Request;

class AerialDatasetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.aerial.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'batch_name' => 'required|string|max:255',
            'dataset_file' => 'required|file|mimes:csv,json,txt|max:10240',
        ]);

        $aerialData = new AerialDataset();
        $aerialData->batch_name = $request->batch_name;
        $aerialData->uploaded_by = auth()->id();
        $aerialData->save();

        return redirect()->route('dashboard')->with('status', 'Aerial Dataset Uploaded Successfully for clustering analysis.');
    }

    /**
     * Display the specified resource.
     */
    public function show(AerialDataset $aerialDataset)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AerialDataset $aerialDataset)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AerialDataset $aerialDataset)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AerialDataset $aerialDataset)
    {
        //
    }
}
