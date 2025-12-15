<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        
        // Debug: Check what's being sent
        \Log::info('Profile update attempt', [
            'user_id' => $user->id,
            'old_username' => $user->username,
            'new_username' => $request->username
        ]);
        
        $validated = $request->validate([
            'username' => ['required', 'string', 'max:255', 'unique:users,username,' . $user->id . ',id'],
        ]);

        try {
            // Update username and timestamp
            $user->username = $validated['username'];
            $user->updated_date = now();
            $user->save();
            
            \Log::info('Profile updated successfully', ['username' => $user->username]);

            return redirect()->route('profile.edit')
                ->with('success', 'Username updated successfully!');
                
        } catch (\Exception $e) {
            \Log::error('Profile update failed', ['error' => $e->getMessage()]);
            
            return redirect()->route('profile.edit')
                ->with('error', 'Failed to update profile: ' . $e->getMessage());
        }
    }
    
    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $user = Auth::user();
        
        try {
            $user->password = Hash::make($validated['password']);
            $user->updated_date = now();
            $user->save();

            return redirect()->route('profile.edit')
                ->with('success', 'Password updated successfully!');
                
        } catch (\Exception $e) {
            \Log::error('Password update failed', ['error' => $e->getMessage()]);
            
            return redirect()->route('profile.edit')
                ->with('error', 'Failed to update password: ' . $e->getMessage());
        }
    }
}