@extends('layouts.main')
@section('sub_judul','Barang Masuk | Tambah')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('kategori.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label class="font-weight-bold">Tanggal Barang Keluar</label>
                                <input type="date" class="form-control @error('tgl_masuk') is-invalid @enderror" name="tgl_masuk" value="{{ old('deskripsi') }}" placeholder="Isikan Deskripsi">

                                <!-- error message untuk nama -->
                                @error('tgl_masuk')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Jumlah Barang Masuk</label>
                        
                                <input type="number" id="qty_masuk" name="qty_masuk" min="1" >
                                <!-- error message untuk kelas -->
                                @error('qty_masuk')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Merk | Seri</label>
                                <br/>

                                <select class="form-select" name="barang_id" required aria-label="Default select example">
                                        <option>Pilih Kategori</option>
                                        @foreach($rsetBarang as $rowbarang)
                                            <option value="{{ $rowbarang->id }}" >{{ $rowbarang->merk }} | {{ $rowbarang->seri }}</option>
                                        @endforeach
                                </select>


                                <!-- error message untuk kelas -->
                                @error('qty_masuk')
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