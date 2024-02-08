<?php

namespace App\Http\Controllers;

use App\Models\Cursus;
use App\Models\Cv;
use Illuminate\Http\Request;

class Formcontroller extends Controller
{
    public function index()
    {
        return view('cv.cv_form');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'degree' => 'required|string',
            'institution' => 'required|string',
            'start_year' => 'required|integer',
            'end_year' => 'nullable|integer',
        ]);

        // Find the cv for the authenticated user
        $cv = Cv::where('user_id', auth()->id())->firstOrFail();

        // Create a new cursus instance
        $cursus = new Cursus();
        $cursus->cv_id = $cv->id; // Assign the cv_id from the found cv
        $cursus->degree = $validatedData['degree'];
        $cursus->institution = $validatedData['institution'];
        $cursus->start_year = $validatedData['start_year'];
        $cursus->end_year = $validatedData['end_year'];

        // Save the cursus to the database
        $cursus->save();

        // Optionally, you can redirect the user after saving
        return redirect()->back()->with('success', 'Cursus created successfully!');
    }
    public function getUserCursus()
{
    $cvId = Cv::where('user_id', auth()->id())->pluck('id')->first();

    // Fetch cursus for the authenticated user using the cv_id
    $cursus = Cursus::where('cv_id', $cvId)->get();

    return response()->json($cursus);

}

}
