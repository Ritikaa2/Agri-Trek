<?php

namespace App\Http\Controllers;

use App\Models\Scheme;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SchemeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schemes = Scheme::where('status', 'active')->get();
        
        $appliedSchemeIds = [];
        $applicationsByScheme = collect();
        if (Auth::user() && Auth::user()->farmer) {
            $applicationsByScheme = Auth::user()->farmer->applications()->get()->keyBy('scheme_id');
            $appliedSchemeIds = $applicationsByScheme->keys()->toArray();
        }

        return view('farmer.schemes.index', compact('schemes', 'appliedSchemeIds', 'applicationsByScheme'));
    }

    /**
     * Apply for a scheme.
     */
    public function apply(Request $request, Scheme $scheme)
    {
        $user = Auth::user();

        if (!$user->farmer) {
            return redirect()->route('farmer.kyc.create')->with('error', 'Please complete your KYC profile to apply for schemes.');
        }

        // Check if already applied
        $existingApplication = Application::where('farmer_id', $user->farmer->id)
                                        ->where('scheme_id', $scheme->id)
                                        ->first();

        if ($existingApplication) {
            return redirect()->back()->with('error', 'You have already applied for this scheme.');
        }

        // Create application
        Application::create([
            'farmer_id' => $user->farmer->id,
            'scheme_id' => $scheme->id,
            'status' => 'pending',
            'application_date' => now(),
        ]);

        return redirect()->back()->with('success', 'Application submitted successfully for ' . $scheme->name);
    }

    /**
     * Display the user's applied schemes.
     */
    public function myApplications()
    {
        $user = Auth::user();

        if (!$user->farmer) {
            return redirect()->route('farmer.kyc.create')->with('error', 'Please complete your KYC profile first.');
        }

        $applications = Application::with('scheme')
                                   ->where('farmer_id', $user->farmer->id)
                                   ->orderBy('created_at', 'desc')
                                   ->get();

        return view('farmer.schemes.my-applications', compact('applications'));
    }
}
