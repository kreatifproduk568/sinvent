<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class CategoryController extends Controller
{
    public function index(){
        //mengakses record table kategori semua record
        $rsetCategory = Kategori::all();

        //mengirim data ke view
        //parameter: path dan nama file view, object data yang dikirim
        // echo $rsetCategory[0]->id;
        // echo $rsetCategory[0]->deskripsi;
        // echo $rsetCategory[0]->kategori;
        // echo "<br>";
        // echo $rsetCategory[1]->id;
        // echo $rsetCategory[1]->deskripsi;
        // echo $rsetCategory[1]->kategori;
        // echo "<br>";
        // return("OK");
        return view('v_kategori.demo',compact('rsetCategory'));
        //return view('layouts.master');
    }
}
