<?php

namespace App\Http\Controllers;

// mengakses class model Kategori
use App\Models\Kategori;

//import return type redirectResponse
use Illuminate\Http\RedirectResponse;

//import return type View
use Illuminate\View\View;

//import Facades Storage
use Illuminate\Support\Facades\Storage;

//import query builder
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //membuat object untuk menampung data hasil query
        //nama object $kategori
        //Class Kategori
        //method latest(), paginate()
        // $rsetKategori = Kategori::latest()->paginate(2);


        // // $rsetKategori = DB::table('kategori')
        //                 ->select('id','deskripsi', 
        //                           DB::raw('getKategoriName(kategori) as kat'))
        //                 ->where('id','like','%'.$request->search.'%')
        //                 ->orWhere('deskripsi','like','%'.$request->search.'%')
        //                 ->orWhere('kategori','like','%'.$request->search.'%')
        //                 ->paginate(2);
        
        
    //     //return $rsetKategori;
         if ($request->search){
             //query builder
            $rsetKategori = DB::table('kategori')
                            ->select('id','deskripsi', 
                                     DB::raw('getKategoriName(kategori) as kat'))
                            ->where('id','like','%'.$request->search.'%')
                            ->orWhere('deskripsi','like','%'.$request->search.'%')
                            ->orWhere('kategori','like','%'.$request->search.'%')
                            ->paginate(2);
           
         }else {
            $rsetKategori = DB::table('vKategori')
                            ->select('id','deskripsi', 'kategori', 'kat')
                            ->paginate(2);
    //         $page = request('page', 1);
    //         $pageSize = 10;
    //         // memanggil stored procedure getKategoriAll()
    //         $rsetKategori = DB::select('call getKategoriAll()');
    //         $offset = ($page * $pageSize) - $pageSize;
    //         $data = array_slice($rsetKategori, $offset, $pageSize, true);
    //     $paginator = new \Illuminate\Pagination\LengthAwarePaginator($data, count($data), $pageSize, $page);

    // return view('v_kategori.index', ['rsetKategori' => $paginator]);
            
        }
        
        //mengirim data ke view
        //ke folder ./resources/views/kategori
        //file yang diakses index.blade.php
        //data yang dikirim object $kategori, sebagai argumen tanda $ dihilangkan

        //return $request->search;
        return view('v_kategori.index',compact('rsetKategori'));
        //return view("layouts/main");
      
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //$rsetKategori = DB::table('kategori')->select('id','deskripsi',DB::raw('getKategori(kategori) as kat'))
        //$rsetKategori = DB::table('kategori')->select(DB::raw('distinct kategori,getKategori(kategori) as kat'))->get();
        //return $aKategori;
       $aKategori = ['M'=>'Modal','A'=>'Alat','BHP'=> 'Bahan Habis Pakai','BTHP'=>'Bahan Tidak Habis Pakai'];
       return view('v_kategori.create',compact('aKategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {

        //cek data
        // echo "data deskripsi";
        // echo $request->deskripsi;
        // die('asd');

        //validate form
        $request->validate([
            'deskripsi'  => 'required|unique:kategori|max:100',
            'kategori'   => 'required|in:M,A,BHP,BTHP'
        ]);
        

        // return $request->all();

        //create kategori
        // Kategori::create([
        //     'deskripsi'  => $request->deskripsi,
        //     'kategori'   => $request->kategori
        // ]);



        try {
            DB::beginTransaction(); // <= Starting the transaction
            // Insert a new order history
            DB::table('kategori')->insert([
                'deskripsi' => $request->deskripsi,
                'kategori' => $request->kategori,
            ]);
        
            DB::commit(); // <= Commit the changes
        } catch (\Exception $e) {
            report($e);
            
            DB::rollBack(); // <= Rollback in case of an exception
        }
        //redirect to index
        return redirect()->route('kategori.index')->with(['success' => 'Data Berhasil Disimpan!']);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //memanggil strored procedure getKategoriById(?)
        $rsetKategori = DB::select('call getKategoriById(?)',[$id]);
        //return $rsetKategori[0]->id;
        //dd($rsetKategori);
        return view('v_kategori.show', compact('rsetKategori'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $aKategori = array('blank'=>'Pilih Kategori',
            'M'=>'Barang Modal',
            'A'=>'Alat',
            'BHP'=>'Bahan Habis Pakai',
            'BTHP'=>'Bahan Tidak Habis Pakai'
        );

          //get product by ID
          $rsetKategori = Kategori::findOrFail($id);

          //render view with product
          return view('v_kategori.edit', compact('rsetKategori','aKategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $validated = $request->validate([
            'deskripsi'   => 'required',
            'kategori'    => 'required | in:M,A,BHP,BTHP',
        ]);

        $rsetKategori = Kategori::find($id);

        $rsetKategori->update([
            'deskripsi'  => $request->deskripsi,
            'kategori'   => $request->kategori
            ]);

            //redirect to index
        return redirect()->route('kategori.index')->with(['success' => 'Data Berhasil Diubah!']);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): RedirectResponse
    {
        
         if (DB::table('barang')->where('kategori_id', $id)->exists()){
            return redirect()->route('kategori.index')->with(['Gagal' => 'Data Gagal Dihapus!']);
        } else {
            $rsetKategori = Kategori::find($id);
            $rsetKategori->delete();
            return redirect()->route('kategori.index')->with(['success' => 'Data Berhasil Dihapus!']);
        }
    }

    public function test(){
        return "Hello";
    }
}
