<?php

namespace App\Http\Controllers;

use App\Models\Entreprise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Companycontroller extends Controller
{
  
    public function index(){
        return view('company.form');
    }


    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Assuming logo is an image
            'slogan' => 'required|string|max:255',
            'industry' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
        ]);

        // Handle file upload for logo
        $logoPath = $request->file('logo')->store('images','public');

        // Create a new entreprise instance
        $entreprise = new Entreprise();
        $entreprise->user_id=Auth()->user()->id;
        $entreprise->nom = $validatedData['name'];
        $entreprise->logo = $logoPath;
        $entreprise->slogan = $validatedData['slogan'];
        $entreprise->industrie= $validatedData['industry'];
        $entreprise->description = $validatedData['description'];
        $entreprise->save();

        $user = Auth::user();
        $user->role = 'entreprise';
        $user->save();

        // Redirect back or do something else
        return redirect()->back()->with('success', 'Company created successfully!');
    }

    public function show (){
        $entreprises=Entreprise::all();
        return view('company.index',compact('entreprises'));
    }

    public function searchCompanies(Request $request)
    {
        $query = $request->input('query');

        // Perform the search query
        $companies = Entreprise::where('nom', 'like', '%' . $query . '%')->with('user')->get();

        return response()->json($companies);
    }

    
}
