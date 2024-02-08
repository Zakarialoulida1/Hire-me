<?php

namespace App\Http\Controllers;

use App\Models\Cv;
use App\Models\Language;
use Illuminate\Http\Request;

class LanguageController extends Controller
{

    public function storeLanguage(Request $request)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'language' => 'required|string|max:255',
            'proficiency' => 'required|string|in:Beginner,Intermediate,Advanced,Fluent',
        ]);
       
        $cv = Cv::where('user_id', auth()->id())->firstOrFail();

        // Create a new language instance
        $language = new Language();
        $language->cv_id = $cv->id; // Assuming you have the user_id column in your languages table
        $language->language = $validatedData['language'];
        $language->proficiency = $validatedData['proficiency'];
        $language->save();
       
        // Return a success response
        return response()->json(['message' => 'Language added successfully'], 200);
    }

    public function getUserLanguage()
    {

        $cvId = Cv::where('user_id', auth()->id())->pluck('id')->first();

        // Fetch cursus for the authenticated user using the cv_id
       
        $userLanguages = Language::where('cv_id',$cvId)->get();
        return response()->json($userLanguages);
    }
    public function deleteLanguage($id){
        $language=Language::findOrFail($id);
        $language->delete();
         return response()->json(['message' => 'Experience deleted successfully']);
    }
}
