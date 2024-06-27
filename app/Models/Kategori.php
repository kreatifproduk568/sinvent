<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    // seting property $table untuk menentukan nama tabel yang diakses
    protected $table = "kategori";

    // menambahkan Mass Assignment
    // menentukan field-field table kategori yang bisa dimanipulasi (CRUD)
    // menggunakan property $fillable
    // $fillable property bertipe array, berisi data field-field table yang CRUD
    // Scope akses dibatasi hanya local satu class saja dengan protected
    // table kategori field yang bisa dimanipulasi: deskripsi, kategori
    //protected $fillable = ["deskripsi", "kategori"];
    protected $fillable = ["deskripsi", "kategori"];
}
