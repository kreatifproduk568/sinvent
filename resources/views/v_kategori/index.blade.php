@extends('layouts.main')

@section('sub_judul','Kategori')
@section('pdf_report','/generate-pdf')
@section('content')
<div class="container">
   
    <div class="row">
        <div class="col-md-6 bg-light text-left">
        <a href="{{ route('kategori.create') }}" class="btn btn-md btn-success btn-sm">TAMBAH</a>
        </div>
        <div class="col-md-6 bg-light text-right">
        <form action="/kategori" method="GET"
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
                            @forelse ($rsetKategori as $rowkategori)
                                <tr>
                                    <td>{{ $rowkategori->id }}</td>
                                    <td>{{ $rowkategori->deskripsi }}</td>
                                    <td>{{ $rowkategori->kat }}</td> 
                                    {{-- <td>{{ $jenisKategori[$rowkategori->jenis] }}</td> --}}
                                    {{-- <td class="text-center">
                                        <img src="{{ asset('storage/foto_barang/'.$rowbarang->foto) }}" class="rounded" style="width: 150px">
                                    </td> --}}
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
                   
                   {{ $rsetKategori->links() }}                     
                </div>
            </div>
        </div>
    </div>
@endsection

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
