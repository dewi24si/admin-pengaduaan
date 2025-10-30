@extends('layouts.app')

@section('title', 'Tambah Tindak Lanjut')
@section('page_title', 'Tambah Data Tindak Lanjut')

@section('content')
<div class="card shadow-sm">
    <div class="card-body">
        <a href="{{ route('tindak.index') }}" class="btn btn-secondary mb-3">← Kembali</a>

        <form action="{{ route('tindak.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Input manual kategori pengaduan --}}
            <div class="mb-3">
                <label class="form-label">Kategori Pengaduan</label>
                <input 
                    type="text" 
                    name="kategori_pengaduan" 
                    value="{{ old('kategori_pengaduan') }}" 
                    class="form-control @error('kategori_pengaduan') is-invalid @enderror" 
                    placeholder="Masukkan kategori pengaduan secara manual"
                    required
                >
                @error('kategori_pengaduan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Petugas --}}
            <div class="mb-3">
                <label class="form-label">Petugas</label>
                <input 
                    type="text" 
                    name="petugas" 
                    value="{{ old('petugas') }}" 
                    class="form-control @error('petugas') is-invalid @enderror" 
                    placeholder="Masukkan nama petugas"
                    required
                >
                @error('petugas')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Aksi --}}
            <div class="mb-3">
                <label class="form-label">Aksi</label>
                <input 
                    type="text" 
                    name="aksi" 
                    value="{{ old('aksi') }}" 
                    class="form-control @error('aksi') is-invalid @enderror" 
                    placeholder="Masukkan tindakan yang dilakukan"
                    required
                >
                @error('aksi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Catatan --}}
            <div class="mb-3">
                <label class="form-label">Catatan</label>
                <textarea 
                    name="catatan" 
                    rows="3" 
                    class="form-control @error('catatan') is-invalid @enderror" 
                    placeholder="Tambahkan catatan tambahan jika ada..."
                >{{ old('catatan') }}</textarea>
                @error('catatan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Foto (Opsional) --}}
            <div class="mb-3">
                <label class="form-label">Foto (Opsional)</label>
                <input 
                    type="file" 
                    name="foto" 
                    class="form-control @error('foto') is-invalid @enderror" 
                    accept="image/*"
                >
                @error('foto')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>
@endsection
