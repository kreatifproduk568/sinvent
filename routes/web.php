<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DemoController;
use App\Http\Controllers\PDFController;

//Route::get('/', [LoginController::class,'index'])->name('login');
Route::get('/',function(){
    return view('welcome');
});
Route::resource('kategori',KategoriController::class)->middleware('auth');
Route::resource('barang',BarangController::class);
Route::resource('category',CategoryController::class);

//demo
//route resource for products
Route::resource('/products', \App\Http\Controllers\ProductController::class);
//->middleware('auth');

Route::get('login', [LoginController::class,'index'])->name('login');
Route::post('login', [LoginController::class,'authenticate']);
Route::post('logout', [LoginController::class,'logout']);

Route::get('register', [RegisterController::class,'create']);
Route::post('register', [RegisterController::class,'store']);

Route::get('login1', [LoginController::class,'index']);
Route::post('actionlogin', [LoginController::class, 'actionlogin']);

// Demo controller
Route::get('/demo',[DemoController::class,'index']);
Route::get('/test',[KategoriController::class,'test']);

//Pdf
Route::get('generate-pdf', [PDFController::class, 'generatePDF']);