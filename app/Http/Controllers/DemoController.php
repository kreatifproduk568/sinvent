<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DemoController extends Controller
{
    public function index(){
        $rsetKategori = DB::table('kategori')->select('id','deskripsi',DB::raw('getKategori(kategori) as kat'))
                                        ->get();
        
        return view('v_demo.index',compact('rsetKategori'));

    }
}
