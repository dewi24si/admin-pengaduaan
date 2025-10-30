@extends('layouts.app')

@section('title', 'Edit Tindak Lanjut')
@section('page_title', 'Edit Data Tindak Lanjut')

@section('content')
<div class="card shadow-sm">
    <div class="card-body">
        <a href="{{ route('tindak.index') }}" class="btn btn-secondary mb-3">← Kembali</a>

        <form action="{{ route('tindak.update', $tindak->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Dropdown Kategori Pengaduan --}}
            <div class="mb-3">
                <label class="form-label">Kategori Pengaduan</label>
                <select name="kategori_id" class="form-select @error('kategori_id') is-invalid @enderror" required>
                    <option value="">-- Pilih Kategori Pengaduan --</option>
                    @foreach ($kategori as $item)
                        <option value="{{ $item->kategori_id }}" {{ $tindak->kategori_id == $item->kategori_id ? 'selected' : '' }}>
                            {{ $item->nama }}
                        </option>
                    @endforeach
                </select>
                @error('kategori_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Nama Pengaduan --}}
            <div class="mb-3">
                <label class="form-label">Nama Pengaduan</label>
                <input 
                    type="text" 
                    name="pengaduan" 
                    value="{{ old('pengaduan', $tindak->pengaduan) }}" 
                    class="form-control @error('pengaduan') is-invalid @enderror" 
                    required
                >
                @error('pengaduan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Petugas --}}
            <div class="mb-3">
                <label class="form-label">Petugas</label>
                <input 
                    type="text" 
                    name="petugas" 
                    value="{{ old('petugas', $tindak->petugas) }}" 
                    class="form-control @error('petugas') is-invalid @enderror" 
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
                    value="{{ old('aksi', $tindak->aksi) }}" 
                    class="form-control @error('aksi') is-invalid @enderror" 
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
                >{{ old('catatan', $tindak->catatan) }}</textarea>
                @error('catatan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Foto --}}
            <div class="mb-3">
                <label class="form-label">Foto Sekarang</label><br>
                @if ($tindak->foto)
                    <img src="{{ asset('storage/' . $tindak->foto) }}" width="100" class="mb-2 rounded">
                @else
                    <p><small>Tidak ada foto</small></p>
                @endif
                <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror" accept="image/*">
                @error('foto')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Update</button>
        </form>
    </div>
</div>
@endsection
