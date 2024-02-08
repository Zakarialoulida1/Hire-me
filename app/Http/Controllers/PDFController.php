<?php

namespace App\Http\Controllers;

use App\Models\Cv;
use Illuminate\Http\Request;
use PDF;

class PDFController extends Controller
{
    public function generatePDF()
    {
       $cv=Cv::where('user_id',)
       // $html = view('cv.cv_form')->render();

        // Generate the PDF
        $pdf = PDF::loadHTML($html);
        return $pdf->download('sample.pdf');
    }
}
