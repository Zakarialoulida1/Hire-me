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


    public function show() {
        $userRole = Auth::user()->role;

        if ($userRole === 'entreprise') {
            $offres = Auth::user()->entreprise->offres;
        } else {
            $offres = Offre::all();
        }

        return view('offre.index', compact('offres'));
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
}
