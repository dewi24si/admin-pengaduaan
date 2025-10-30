@extends('layouts.app')
@section('title', 'Edit Warga')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-warning text-dark">
            <h5 class="mb-0"><i class="bi bi-pencil me-2"></i>Edit Data Warga</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('warga.update', $warga->warga_id) }}" method="POST">
                @csrf @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">No KTP <span class="text-danger">*</span></label>
                        <input type="text" name="no_ktp" class="form-control @error('no_ktp') is-invalid @enderror"
                            value="{{ old('no_ktp', $warga->no_ktp) }}" required maxlength="16">
                        @error('no_ktp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                            value="{{ old('nama', $warga->nama) }}" required>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                        <select name="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror"
                            required>
                            <option value="">-- Pilih Jenis Kelamin --</option>
                            <option value="L"
                                {{ old('jenis_kelamin', $warga->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki
                            </option>
                            <option value="P"
                                {{ old('jenis_kelamin', $warga->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan
                            </option>
                        </select>
                        @error('jenis_kelamin')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Agama <span class="text-danger">*</span></label>
                        <input type="text" name="agama" class="form-control @error('agama') is-invalid @enderror"
                            value="{{ old('agama', $warga->agama) }}" required>
                        @error('agama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Pekerjaan <span class="text-danger">*</span></label>
                        <input type="text" name="pekerjaan" class="form-control @error('pekerjaan') is-invalid @enderror"
                            value="{{ old('pekerjaan', $warga->pekerjaan) }}" required>
                        @error('pekerjaan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Telepon <span class="text-danger">*</span></label>
                        <input type="text" name="telp" class="form-control @error('telp') is-invalid @enderror"
                            value="{{ old('telp', $warga->telp) }}" required>
                        @error('telp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email', $warga->email) }}">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('warga.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Kembali
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-check-circle me-2"></i>Update Data
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
