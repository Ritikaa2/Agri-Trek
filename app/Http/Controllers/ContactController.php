<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMessageMail;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        // Send actual email using Gmail SMTP
        Mail::to('ritikatoore@gmail.com')->send(new ContactMessageMail(
            $validated['name'],
            $validated['email'],
            $validated['message']
        ));

        return back()->with('success', 'Thank you! Your message has been sent to our Agronomy Experts. We will reply to ' . $validated['email'] . ' shortly.');
    }
}
