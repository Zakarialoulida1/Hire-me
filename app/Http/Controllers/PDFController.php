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
       
        // $html = view('cv.cv')->render();
       
        // // Generate the PDF
        // $pdf = PDF::loadHTML($html);
        // return $pdf->download('cv.pdf');

        $cv = Cv::where('user_id', Auth::id())->firstOrFail();
        $user = Auth::user();
        $cursuses = $cv->cursuses;
        $languages = $cv->languages;
        $experiences = $cv->experiences;
        $competences = $cv->competences;
    
        // Pass data to the PDF view
        $data = compact('user', 'cursuses', 'languages', 'experiences', 'competences');
    
    
    
        // Extract only the content of the container div
     
        // Generate the PDF
        $pdf = PDF::loadView('cv.cv', $data);
    
        // Download the PDF
        return $pdf->download('sample.pdf');
    }
}
