@extends('layouts.main')
@section('sub_judul','Kategori | Tambah')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('kategori.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label class="font-weight-bold">Deskripsi</label>
                                <input type="text" class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" value="{{ old('deskripsi') }}" placeholder="Isikan Deskripsi">

                                <!-- error message untuk nama -->
                                @error('deskripsi')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Kategori</label>

                                <div class="form-check">
                                    <select class="form-select" name="kategori" required aria-label="Default select example">
                                        <option>Pilih Kategori</option>
                                        @foreach($aKategori as $key=>$val)
                                            <option value="{{ $key }}" >{{ $val }}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <!-- error message untuk kelas -->
                                @error('kategori')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-md btn-primary">SIMPAN</button>
                            <button type="reset" class="btn btn-md btn-warning">RESET</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection