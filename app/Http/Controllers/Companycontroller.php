<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Companycontroller extends Controller
{
  
    public function index(){
        return view('company.form');
    }
}
