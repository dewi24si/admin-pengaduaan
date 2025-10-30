@extends('layouts.app')
@section('title', 'Tambah Penilaian Layanan')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="bi bi-star me-2"></i>Tambah Penilaian Layanan</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('penilaian.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Pengaduan <span class="text-danger">*</span></label>
                    <select name="pengaduan_id" class="form-select @error('pengaduan_id') is-invalid @enderror" required>
                        <option value="">-- Pilih Pengaduan --</option>
                        @foreach ($pengaduan as $p)
                            <option value="{{ $p->pengaduan_id }}"
                                {{ old('pengaduan_id') == $p->pengaduan_id ? 'selected' : '' }}>
                                {{ $p->nomor_tiket }} - {{ $p->judul }} ({{ $p->warga->nama }})
                            </option>
                        @endforeach
                    </select>
                    @error('pengaduan_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text">Hanya menampilkan pengaduan yang belum memiliki penilaian</div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Rating <span class="text-danger">*</span></label>
                    <div class="rating-stars">
                        @for ($i = 1; $i <= 5; $i++)
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="rating" id="rating{{ $i }}"
                                    value="{{ $i }}" {{ old('rating') == $i ? 'checked' : '' }} required>
                                <label class="form-check-label" for="rating{{ $i }}">
                                    @for ($j = 1; $j <= $i; $j++)
                                        ⭐
                                    @endfor
                                    ({{ $i }}) -
                                    @switch($i)
                                        @case(1)
                                            Sangat Tidak Puas
                                        @break

                                        @case(2)
                                            Tidak Puas
                                        @break

                                        @case(3)
                                            Cukup
                                        @break

                                        @case(4)
                                            Puas
                                        @break

                                        @case(5)
                                            Sangat Puas
                                        @break
                                    @endswitch
                                </label>
                            </div>
                        @endfor
                    </div>
                    @error('rating')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Komentar</label>
                    <textarea name="komentar" class="form-control @error('komentar') is-invalid @enderror" rows="4"
                        placeholder="Masukkan komentar (opsional)">{{ old('komentar') }}</textarea>
                    @error('komentar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text">Maksimal 1000 karakter</div>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('penilaian.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Kembali
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-check-circle me-2"></i>Simpan Penilaian
                    </button>
                </div>
            </form>
        </div>
    </div>

    <style>
        .rating-stars .form-check-label {
            font-size: 1.1em;
            padding: 5px 10px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .rating-stars .form-check-label:hover {
            background-color: #f8f9fa;
        }
    </style>
@endsection
