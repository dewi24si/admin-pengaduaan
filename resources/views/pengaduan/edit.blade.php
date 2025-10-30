@extends('layouts.app')
@section('title', 'Edit Pengaduan')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-warning text-dark">
            <h5 class="mb-0"><i class="bi bi-pencil me-2"></i>Edit Pengaduan</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('pengaduan.update', $pengaduan->pengaduan_id) }}" method="POST">
                @csrf @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nomor Tiket <span class="text-danger">*</span></label>
                        <input type="text" name="nomor_tiket"
                            class="form-control @error('nomor_tiket') is-invalid @enderror"
                            value="{{ old('nomor_tiket', $pengaduan->nomor_tiket) }}" required>
                        @error('nomor_tiket')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Warga <span class="text-danger">*</span></label>
                        <select name="warga_id" class="form-select @error('warga_id') is-invalid @enderror" required>
                            <option value="">-- Pilih Warga --</option>
                            @foreach ($warga as $w)
                                <option value="{{ $w->warga_id }}"
                                    {{ old('warga_id', $pengaduan->warga_id) == $w->warga_id ? 'selected' : '' }}>
                                    {{ $w->nama }} - {{ $w->no_ktp }}
                                </option>
                            @endforeach
                        </select>
                        @error('warga_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Judul Pengaduan <span class="text-danger">*</span></label>
                    <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror"
                        value="{{ old('judul', $pengaduan->judul) }}" required>
                    @error('judul')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Kategori Pengaduan</label>
                        <select name="kategori_id" class="form-select @error('kategori_id') is-invalid @enderror">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach ($kategori as $k)
                                <option value="{{ $k->kategori_id }}"
                                    {{ old('kategori_id', $pengaduan->kategori_id) == $k->kategori_id ? 'selected' : '' }}>
                                    {{ $k->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('kategori_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select @error('status') is-invalid @enderror">
                            <option value="baru" {{ old('status', $pengaduan->status) == 'baru' ? 'selected' : '' }}>Baru
                            </option>
                            <option value="proses" {{ old('status', $pengaduan->status) == 'proses' ? 'selected' : '' }}>
                                Proses</option>
                            <option value="selesai" {{ old('status', $pengaduan->status) == 'selesai' ? 'selected' : '' }}>
                                Selesai</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi <span class="text-danger">*</span></label>
                    <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="4" required>{{ old('deskripsi', $pengaduan->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Lokasi</label>
                    <input type="text" name="lokasi_text" class="form-control @error('lokasi_text') is-invalid @enderror"
                        value="{{ old('lokasi_text', $pengaduan->lokasi_text) }}">
                    @error('lokasi_text')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">RT</label>
                        <input type="text" name="rt" class="form-control @error('rt') is-invalid @enderror"
                            value="{{ old('rt', $pengaduan->rt) }}">
                        @error('rt')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">RW</label>
                        <input type="text" name="rw" class="form-control @error('rw') is-invalid @enderror"
                            value="{{ old('rw', $pengaduan->rw) }}">
                        @error('rw')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('pengaduan.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Kembali
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-check-circle me-2"></i>Update Pengaduan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
