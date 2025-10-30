@extends('layouts.app')
@section('title', 'Edit Kategori')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-warning text-dark">
            <h5 class="mb-0"><i class="bi bi-pencil me-2"></i>Edit Kategori Pengaduan</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('kategori.update', $kategori->kategori_id) }}" method="POST">
                @csrf @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Nama Kategori <span class="text-danger">*</span></label>
                    <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                        value="{{ old('nama', $kategori->nama) }}" required>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">SLA (Hari) <span class="text-danger">*</span></label>
                        <input type="number" name="sla_hari" class="form-control @error('sla_hari') is-invalid @enderror"
                            value="{{ old('sla_hari', $kategori->sla_hari) }}" required min="1">
                        @error('sla_hari')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Prioritas <span class="text-danger">*</span></label>
                        <select name="prioritas" class="form-select @error('prioritas') is-invalid @enderror" required>
                            <option value="">-- Pilih Prioritas --</option>
                            <option value="rendah"
                                {{ old('prioritas', $kategori->prioritas) == 'rendah' ? 'selected' : '' }}>Rendah</option>
                            <option value="sedang"
                                {{ old('prioritas', $kategori->prioritas) == 'sedang' ? 'selected' : '' }}>Sedang</option>
                            <option value="tinggi"
                                {{ old('prioritas', $kategori->prioritas) == 'tinggi' ? 'selected' : '' }}>Tinggi</option>
                        </select>
                        @error('prioritas')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('kategori.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Kembali
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-check-circle me-2"></i>Update Kategori
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
