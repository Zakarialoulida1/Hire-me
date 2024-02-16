<?php

namespace App\Http\Controllers;

use App\Models\Offre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Offrecontroller extends Controller
{
    public function index(){
        return view('offre.form');
    }
    public function store(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'titre' => 'required|string',
            'description' => 'required|string',
            'compétences_requises' => 'required|string',
            'type_contrat' => 'required|string',
            'emplacement' => 'required|string',
        ]);

        // Create a new Offre instance and fill it with the validated data
        $offre = new Offre();
        $offre->entreprise_id = auth()->user()->entreprise->id; // Assuming you have a relationship set up between User and Entreprise
        $offre->titre = $validatedData['titre'];
        $offre->description = $validatedData['description'];
        $offre->compétences_requises = $validatedData['compétences_requises'];
        $offre->type_contrat = $validatedData['type_contrat'];
        $offre->emplacement = $validatedData['emplacement'];

        // Save the offre
        $offre->save();

        // Redirect back with success message
        return redirect()->back()->with('success', 'Job offer created successfully!');
    }


    public function search(Request $request)
    {
        $query = $request->input('query');
        
        // Perform the search
        $offers = Offre::where('titre', 'like', '%'.$query.'%')
                       ->orWhere('description', 'like', '%'.$query.'%')
                       ->get();

        // Return search results as JSON
        return response()->json($offers);
    }

    

    
    public function show()
{
    $user = Auth::user();
    $userRole = $user->role;

    if ($userRole === 'entreprise') {
        $offresNotPostulated =  $user->entreprise->offres;
        $offresPostulated = Offre::whereHas('users', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->get();
       
        return view('offre.index', compact('offresNotPostulated', 'offresPostulated'));
    } else {
        // Get offers where the user has not postulated yet
        $offresNotPostulated = Offre::whereDoesntHave('users', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->get();

        // Get offers where the user has already postulated
        $offresPostulated = Offre::whereHas('users', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->get();

        return view('offre.index', compact('offresNotPostulated', 'offresPostulated'));
    }
}


public function postuler(Request $request, $offreId)
{

    // Find the offer by its ID
    $offre = Offre::findOrFail($offreId);


    // Associate the authenticated user with the offer
    $user = auth()->user();
    $user->offres()->attach($offreId);


    // Respond with a success message
    return response()->json(['message' => 'Postulation réussie']);
}

public function delete($offreId){
    $offre=Offre::findorFail($offreId);
    $offre->delete();
    return redirect()->back()->with('Success','');
}
}
