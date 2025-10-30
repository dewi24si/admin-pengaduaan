@extends('layouts.app')
@section('title', 'Edit Pengaduan')

@section('content')
<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('pengaduan.update', $pengaduan->pengaduan_id) }}" method="POST">
            @csrf @method('PUT')

            <div class="mb-3">
                <label>Nomor Tiket</label>
                <input type="text" name="nomor_tiket" class="form-control" value="{{ $pengaduan->nomor_tiket }}" required>
            </div>

            <div class="mb-3">
                <label>Judul</label>
                <input type="text" name="judul" class="form-control" value="{{ $pengaduan->judul }}" required>
            </div>

            <div class="mb-3">
                <label>Kategori Pengaduan</label>
                <select name="kategori_id" class="form-select">
                    @foreach($kategori as $k)
                        <option value="{{ $k->id }}" {{ $k->id == $pengaduan->kategori_id ? 'selected' : '' }}>{{ $k->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="3">{{ $pengaduan->deskripsi }}</textarea>
            </div>

            <div class="mb-3">
                <label>Status</label>
                <select name="status" class="form-select">
                    <option value="baru" {{ $pengaduan->status=='baru'?'selected':'' }}>Baru</option>
                    <option value="proses" {{ $pengaduan->status=='proses'?'selected':'' }}>Proses</option>
                    <option value="selesai" {{ $pengaduan->status=='selesai'?'selected':'' }}>Selesai</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Lokasi</label>
                <input type="text" name="lokasi_text" class="form-control" value="{{ $pengaduan->lokasi_text }}">
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>RT</label>
                    <input type="text" name="rt" class="form-control" value="{{ $pengaduan->rt }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label>RW</label>
                    <input type="text" name="rw" class="form-control" value="{{ $pengaduan->rw }}">
                </div>
            </div>

            <button class="btn btn-success">Update</button>
            <a href="{{ route('pengaduan.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection
