<?php

namespace App\Http\Controllers;

use App\Models\Competence;
use App\Models\Cv;
use Illuminate\Http\Request;

class CompetenceController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $cv=Cv::where('user_id',auth()->id())->firstOrFail();

        $competence = new Competence();
        $competence->name = $request->name;
        $competence->cv_id = $cv->id;
        $competence->save();

        return response()->json($competence);
    }

    public function getUserCompetence()
    {

        
        $cvId = Cv::where('user_id', auth()->id())->pluck('id')->first();

        // Fetch cursus for the authenticated user using the cv_id
       
     
        $competences = Competence::where('cv_id', $cvId)->get();
        return response()->json($competences);
    }

    public function destroy($id)
    {
        $competence = Competence::findOrFail($id);
        $competence->delete();

        return response()->json(['message' => 'Competence deleted successfully']);
    }
}
