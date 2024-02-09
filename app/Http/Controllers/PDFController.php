<?php

namespace App\Http\Controllers;

use App\Models\Cv;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class PDFController extends Controller
{

    public function index(){
     

        $cv = Cv::where('user_id', Auth::id())->firstOrFail();
        $user = Auth::user();
        $cursuses = $cv->cursuses;
        $languages = $cv->languages;
        $experiences = $cv->experiences;
        $competences = $cv->competences;

        // Pass the data to a view for displaying
        return view('cv.cv', compact('user',  'cursuses', 'languages', 'experiences', 'competences'));
    

    }
    public function generatePDF()
    {
       
        $html = view('cv.cv_form')->render();
        $html="<h1>ghghed</h1>";
        // Generate the PDF
        $pdf = PDF::loadHTML($html);
        return $pdf->download('sample.pdf');
    }
}
