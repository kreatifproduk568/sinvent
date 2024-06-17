<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//import query builder
use Illuminate\Support\Facades\DB;
use App\Models\Kategori;
use App\Models\Barang;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->search){
            //query builder
            $rsetBarang = DB::table('barang')
                            ->select('barang.id',
                                    'barang.merk',
                                    'barang.seri', 
                                    'barang.spesifikasi',
                                    'barang.stok',
                                    'barang.kategori_id',
                                    DB::raw('getKategoriName(kategori.kategori) as kat'),
                                    'kategori.deskripsi')
                            ->join('kategori', 'barang.kategori_id', '=', 'kategori.id')
                            ->where('barang.id','like','%'.$request->search.'%')
                            ->orWhere('barang.merk','like','%'.$request->search.'%')
                            ->orWhere('barang.seri','like','%'.$request->search.'%')
                            ->orWhere('barang.stok','like','%'.$request->search.'%')
                            ->orWhere('kategori.kategori','like','%'.$request->search.'%')
                            ->paginate(2);
        }else {
            $rsetBarang = DB::table('barang')
            ->select('barang.id','merk',
                    'seri', 
                    'spesifikasi',
                    'stok',
                    'kategori_id',
                    DB::raw('getKategoriName(kategori.kategori) as kat'),
                    'kategori.deskripsi')
            ->join('kategori', 'barang.kategori_id', '=', 'kategori.id')
           ->paginate(2);
   
       }

        return view('v_barang.index',compact('rsetBarang'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $akategori = Kategori::all();
        return view('v_barang.create',compact('akategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->stok = 0;
        $request->validate([
            'merk'          => 'required',
            'seri'          => 'required',
            'spesifikasi'   => 'required',
            
            'kategori_id'   => 'required',

        ]);

        
        Barang::create([
            'merk'             => $request->merk,
            'seri'             => $request->seri,
            'spesifikasi'      => $request->spesifikasi,
            'stok'             => $request->stok,
            'kategori_id'      => $request->kategori_id,
        ]);


        //return redirect()->route('barang.index')->with(['success' => 'Data Berhasil Disimpan!']);


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
