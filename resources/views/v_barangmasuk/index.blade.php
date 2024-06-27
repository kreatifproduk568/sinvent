@extends('layouts.main')

@section('content')
<div class="container">
   
    <div class="row">
        <div class="col-md-6 bg-light text-left">
        <a href="{{ route('barangmasuk.create') }}" class="btn btn-md btn-success btn-sm">TAMBAH</a>
        </div>
        <div class="col-md-6 bg-light text-right">
        <form action="/barangmasuk" method="GET"
                class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                @csrf
                <div class="input-group">
                    <input type="text" name="search" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" value="{{ request('search') }}">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                </div>
            </form>
        </div>
    </div>
</div>
    <div class="container">
        <div class="row">
           
            <div class="col-md-12">
                <div class="card">
           
                    
                
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>DESKRIPSI</th>
                                <th>KATEGORI</th>
                                <th style="width: 15%">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($rsetBarangmasuk as $rowbarangmasuk)
                                <tr>
                                    <td>{{ $rowbarangmasuk->id }}</td>
                                    <td>{{ $rowbarangmasuk->tgl_masuk }}</td>
                                    <td>{{ $rowbarangmasuk->qty_masuk }}</td> 
                                    
                                    <td class="text-center">
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('kategori.destroy', $rowkategori->id) }}" method="POST">
                                            <a href="{{ route('kategori.show', $rowkategori->id) }}" class="btn btn-sm btn-dark"><i class="fa fa-eye"></i></a>
                                            <a href="{{ route('kategori.edit', $rowkategori->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-pencil-alt"></i></a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <div class="alert">
                                    Data kategori belum tersedia
                                </div>
                            @endforelse
                        </tbody>
                    </table>
                   
                   {{ $rsetBarangmasuk->links() }}                     
                </div>
            </div>
        </div>
    </div>
@endsection