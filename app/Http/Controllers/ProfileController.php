<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    // public function update(ProfileUpdateRequest $request): RedirectResponse
    // {
    //     $request->user()->fill($request->validated());

    //     if ($request->user()->isDirty('email')) {
    //         $request->user()->email_verified_at = null;
    //     }
    //     $request->user()->save();
    //     return Redirect::route('profile.edit')->with('status', 'profile-updated');
    // }
public function update(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Assuming image is an optional field
        ]);

        // Get the authenticated user
        $user = Auth::user();

        // Update name and email
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];

        // Check if an image is provided
        if ($request->hasFile('image')) {
            // Store the new image
            $imagePath = $request->file('image')->store('images', 'public');

            // Delete the old image if exists
            if ($user->image) {
                Storage::disk('public')->delete($user->image);
            }

            // Update user's image column
            $user->image = $imagePath;
        }

        // Save the updated user record
        $user->save();

        // Redirect back with success message
        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
