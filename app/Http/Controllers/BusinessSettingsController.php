<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BusinessSettingsController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('settings.business', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
            'business_name' => 'required|string|max:255',
            'business_address' => 'required|string',
            'business_phone' => 'required|string|max:20',
            'business_email' => 'required|email|max:255',
            'gstin' => 'nullable|string|max:20',
        ]);

        $user = Auth::user();
        $user->update($request->all());

        return back()->with('success', 'Business profile updated successfully! 🚀');
    }
}
