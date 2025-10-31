@extends('layouts.app')
@section('title', 'Edit Tindak Lanjut')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-warning text-dark">
            <h5 class="mb-0"><i class="bi bi-pencil me-2"></i>Edit Tindak Lanjut</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('tindak.update', $tindak->tindak_id) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Pengaduan <span class="text-danger">*</span></label>
                    <select name="pengaduan_id" class="form-select @error('pengaduan_id') is-invalid @enderror" required>
                        <option value="">-- Pilih Pengaduan --</option>
                        @foreach ($pengaduan as $p)
                            <option value="{{ $p->pengaduan_id }}"
                                {{ old('pengaduan_id', $tindak->pengaduan_id) == $p->pengaduan_id ? 'selected' : '' }}>
                                {{ $p->nomor_tiket }} - {{ $p->judul }} ({{ $p->warga->nama }})
                            </option>
                        @endforeach
                    </select>
                    @error('pengaduan_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Petugas <span class="text-danger">*</span></label>
                        <input type="text" name="petugas" class="form-control @error('petugas') is-invalid @enderror"
                            value="{{ old('petugas', $tindak->petugas) }}" required>
                        @error('petugas')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Aksi <span class="text-danger">*</span></label>
                        <input type="text" name="aksi" class="form-control @error('aksi') is-invalid @enderror"
                            value="{{ old('aksi', $tindak->aksi) }}" required>
                        @error('aksi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Catatan</label>
                    <textarea name="catatan" class="form-control @error('catatan') is-invalid @enderror" rows="4">{{ old('catatan', $tindak->catatan) }}</textarea>
                    @error('catatan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Foto</label>
                    @if ($tindak->foto)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $tindak->foto) }}" alt="Foto Tindak Lanjut"
                                class="img-thumbnail" style="max-height: 150px;">
                            <div class="form-text">Foto saat ini</div>
                        </div>
                    @endif
                    <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror"
                        accept="image/jpeg,image/png,image/jpg">
                    @error('foto')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text">Kosongkan jika tidak ingin mengubah foto</div>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('tindak.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Kembali
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-check-circle me-2"></i>Update Tindak Lanjut
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
