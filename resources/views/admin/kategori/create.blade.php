@extends('layouts.app')

@section('title', 'Tambah Kategori Pengaduan')

@section('content')
<div class="card shadow-sm">
    <div class="card-body">
        <h5 class="mb-3">Tambah Kategori Pengaduan</h5>

        <form action="{{ route('kategori.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Kategori</label>
                <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama') }}" required>
            </div>

            <div class="mb-3">
                <label for="sla_hari" class="form-label">SLA (Hari)</label>
                <input type="number" class="form-control" id="sla_hari" name="sla_hari" value="{{ old('sla_hari') }}" required>
            </div>

            <div class="mb-3">
                <label for="prioritas" class="form-label">Prioritas</label>
                <select class="form-select" id="prioritas" name="prioritas" required>
                    <option value="">-- Pilih Prioritas --</option>
                    <option value="rendah" {{ old('prioritas') == 'rendah' ? 'selected' : '' }}>Rendah</option>
                    <option value="sedang" {{ old('prioritas') == 'sedang' ? 'selected' : '' }}>Sedang</option>
                    <option value="tinggi" {{ old('prioritas') == 'tinggi' ? 'selected' : '' }}>Tinggi</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="{{ route('kategori.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection
