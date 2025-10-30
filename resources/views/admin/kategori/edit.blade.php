@extends('layouts.app')

@section('title', 'Edit Kategori Pengaduan')

@section('content')
<div class="card shadow-sm">
    <div class="card-body">
        <h5 class="mb-3">Edit Kategori Pengaduan</h5>

        <form action="{{ route('kategori.update', $kategori->kategori_id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nama" class="form-label">Nama Kategori</label>
                <input type="text" class="form-control" id="nama" name="nama" value="{{ $kategori->nama }}" required>
            </div>

            <div class="mb-3">
                <label for="sla_hari" class="form-label">SLA (Hari)</label>
                <input type="number" class="form-control" id="sla_hari" name="sla_hari" value="{{ $kategori->sla_hari }}" required>
            </div>

            <div class="mb-3">
                <label for="prioritas" class="form-label">Prioritas</label>
                <select class="form-select" id="prioritas" name="prioritas" required>
                    <option value="rendah" {{ $kategori->prioritas == 'rendah' ? 'selected' : '' }}>Rendah</option>
                    <option value="sedang" {{ $kategori->prioritas == 'sedang' ? 'selected' : '' }}>Sedang</option>
                    <option value="tinggi" {{ $kategori->prioritas == 'tinggi' ? 'selected' : '' }}>Tinggi</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('kategori.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection
