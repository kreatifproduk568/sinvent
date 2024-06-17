<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// mengakses class model Kategori
use App\Models\Kategori;
//import return type View
use Illuminate\View\View;

use App\Models\User;
use PDF;

class PDFController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generatePDF()
    {
        $users = User::get();
        $rsetKategori = Kategori::all();
    
        $data = [
            'title' => 'Kategori',
            'date' => date('m/d/Y'),
            'rsetKategori' => $rsetKategori
        ]; 
    
       
              
        $pdf = PDF::loadView('pdf.pdf_kategori_all', $data);
       
        return $pdf->download('itsolutionstuff.pdf');
    }
}
