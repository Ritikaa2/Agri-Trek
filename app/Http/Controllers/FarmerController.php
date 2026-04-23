<?php

namespace App\Http\Controllers;

use App\Models\Farmer;
use Illuminate\Http\Request;

class FarmerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function create()
    {
        if (auth()->user()->farmer) {
            return redirect()->route('dashboard')->with('status', 'KYC already completed!');
        }
        return view('farmer.kyc.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'aadhaar_no' => 'required|string|size:12|unique:farmers',
            'phone' => 'required|string|max:15',
            'address' => 'required|string',
            'village' => 'required|string|max:100',
            'district' => 'required|string|max:100',
        ]);

        auth()->user()->farmer()->create($validated);

        return redirect()->route('dashboard')->with('status', 'KYC Profile created successfully! You can now register land.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Farmer $farmer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Farmer $farmer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Farmer $farmer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Farmer $farmer)
    {
        //
    }
}
