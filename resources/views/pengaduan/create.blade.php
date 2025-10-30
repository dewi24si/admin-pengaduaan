@extends('layouts.app')
@section('title', 'Tambah Pengaduan')

@section('content')
<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('pengaduan.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>Nomor Tiket</label>
                <input type="text" name="nomor_tiket" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Judul</label>
                <input type="text" name="judul" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Kategori Pengaduan</label>
                <select name="kategori_id" class="form-select">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($kategori as $k)
                        <option value="{{ $k->id }}">{{ $k->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="3" required></textarea>
            </div>

            <div class="mb-3">
                <label>Status</label>
                <select name="status" class="form-select">
                    <option value="baru">Baru</option>
                    <option value="proses">Proses</option>
                    <option value="selesai">Selesai</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Lokasi</label>
                <input type="text" name="lokasi_text" class="form-control">
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>RT</label>
                    <input type="text" name="rt" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label>RW</label>
                    <input type="text" name="rw" class="form-control">
                </div>
            </div>

            <button class="btn btn-success">Simpan</button>
            <a href="{{ route('pengaduan.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection
