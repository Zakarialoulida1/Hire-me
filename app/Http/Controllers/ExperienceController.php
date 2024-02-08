<?php

namespace App\Http\Controllers;

use App\Models\Cv;
use App\Models\Experience;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'position' => 'required|string',
            'company' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
        ]);
        $cv = Cv::where('user_id', auth()->id())->firstOrFail();

        // Create a new experience instance
        $experience = new Experience();
        $experience->cv_id = $cv->id;
        $experience->position = $validatedData['position'];
        $experience->company = $validatedData['company'];
        $experience->start_year = $validatedData['start_date'];
        $experience->end_year = $validatedData['end_date'];
        
        // Associate the experience with the authenticated user
       

        // Save the experience to the database
        $experience->save();

        // Return a success response
        return response()->json(['message' => 'Experience created successfully'], 201);
    }

    public function getUserExperience()
    {

        $cvId = Cv::where('user_id', auth()->id())->pluck('id')->first();

        // Fetch cursus for the authenticated user using the cv_id
       
        // Fetch experiences for authenticated user
        $experiences = Experience::where('cv_id', $cvId)->get();

        // Return experiences as JSON response
        return response()->json($experiences);
    }

    public function destroy($id)
    {
        return $id;
        $experience = Experience::findOrFail($id);
        $experience->delete();
        return response()->json(['message' => 'Experience deleted successfully']);
    }
}
