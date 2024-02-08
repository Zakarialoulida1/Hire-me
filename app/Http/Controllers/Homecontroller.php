<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Homecontroller extends Controller
{

    public function index()
    {
if(Auth::id()){
    $role=Auth()->user()->role;
    if($role=='user')
return view('dashboard');
elseif($role == 'entreprise')
    return view('company.form');
    elseif ($role == 'admin')
        return view('admin.admin ');
}
    }
}
