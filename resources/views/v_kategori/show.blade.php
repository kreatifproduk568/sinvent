@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
               <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <table>
                            <tr>
                                <td>Id</td>
                                <td>:{{ $rsetKategori[0]->id }}</td>
                            </tr>
                            <tr>
                                <td>Deskripsi</td>
                                <td>:{{ $rsetKategori[0]->deskripsi }}</td>
                            <tr>
                                <td>Kategori</td>
                                <td>:{{ $rsetKategori[0]->kat }}</td>
                            </tr>
                        </table>
                        
                    </div>
               </div>
            </div>



        </div>
        <div class="row">
            <div class="col-md-12  text-center">


                <a href="{{ route('kategori.index') }}" class="btn btn-md btn-primary mb-3">Back</a>
            </div>
        </div>
    </div>
@endsection
