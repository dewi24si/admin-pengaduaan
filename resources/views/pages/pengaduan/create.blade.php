@extends('layouts.app')
@section('title', 'Tambah Pengaduan')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="bi bi-chat-left-text me-2"></i>Tambah Pengaduan</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('pengaduan.store') }}" method="POST" enctype="multipart/form-data" id="pengaduanForm">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nomor Tiket <span class="text-danger">*</span></label>
                        <input type="text" name="nomor_tiket"
                            class="form-control @error('nomor_tiket') is-invalid @enderror" value="{{ old('nomor_tiket') }}"
                            required placeholder="Masukkan nomor tiket">
                        @error('nomor_tiket')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Warga <span class="text-danger">*</span></label>
                        <select name="warga_id" class="form-select @error('warga_id') is-invalid @enderror" required>
                            <option value="">-- Pilih Warga --</option>
                            @foreach ($warga as $w)
                                <option value="{{ $w->warga_id }}" {{ old('warga_id') == $w->warga_id ? 'selected' : '' }}>
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
                        value="{{ old('judul') }}" required placeholder="Masukkan judul pengaduan">
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
                                    {{ old('kategori_id') == $k->kategori_id ? 'selected' : '' }}>
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
                            <option value="baru" {{ old('status') == 'baru' ? 'selected' : '' }}>Baru</option>
                            <option value="proses" {{ old('status') == 'proses' ? 'selected' : '' }}>Proses</option>
                            <option value="selesai" {{ old('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi <span class="text-danger">*</span></label>
                    <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="4" required
                        placeholder="Masukkan deskripsi pengaduan">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Lokasi</label>
                    <input type="text" name="lokasi_text" class="form-control @error('lokasi_text') is-invalid @enderror"
                        value="{{ old('lokasi_text') }}" placeholder="Masukkan lokasi kejadian">
                    @error('lokasi_text')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">RT</label>
                        <input type="text" name="rt" class="form-control @error('rt') is-invalid @enderror"
                            value="{{ old('rt') }}" placeholder="Masukkan RT">
                        @error('rt')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">RW</label>
                        <input type="text" name="rw" class="form-control @error('rw') is-invalid @enderror"
                            value="{{ old('rw') }}" placeholder="Masukkan RW">
                        @error('rw')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- FILE UPLOAD SECTION FOR COVER/FOTO BERITA -->
                <div class="card mb-4">
                    <div class="card-header bg-light">
                        <h6 class="mb-0">
                            <i class="bi bi-images me-2"></i>Foto/Cover Berita
                            <small class="text-muted">(Opsional)</small>
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Pilih Foto</label>
                            <input type="file" name="files[]" id="fileInput"
                                class="form-control @error('files.*') is-invalid @enderror" multiple
                                accept=".jpg,.jpeg,.png,.gif">
                            @error('files.*')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Dapat mengupload lebih dari satu foto sebagai cover/ilustrasi berita.
                                Format: JPG, JPEG, PNG, GIF (Maksimal 2MB per file)</small>
                        </div>

                        <!-- File Preview Area -->
                        <div class="file-preview-area mt-3" id="filePreview">
                            <p class="text-muted mb-2">Pratinjau foto:</p>
                            <div class="row" id="imageList"></div>
                        </div>

                        <!-- Uploaded Files Info -->
                        <div class="alert alert-info mt-3">
                            <i class="bi bi-info-circle me-2"></i>
                            Foto akan disimpan dalam tabel media dengan:
                            <ul class="mb-0 mt-2">
                                <li>ref_table = 'pengaduan'</li>
                                <li>ref_id = [ID Pengaduan]</li>
                                <li>file_name = [nama file yang diupload]</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('pengaduan.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Kembali
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-check-circle me-2"></i>Simpan Pengaduan
                    </button>
                </div>
            </form>
        </div>
    </div>

@section('scripts')
    <script>
        // Array untuk menyimpan file
        let selectedFiles = [];

        // Image Preview Script
        document.getElementById('fileInput').addEventListener('change', function(e) {
            const imageList = document.getElementById('imageList');

            // Tambahkan file baru ke array
            Array.from(this.files).forEach((file) => {
                if (file.type.startsWith('image/')) {
                    // Cek apakah file sudah ada
                    const existingFile = selectedFiles.find(f => f.name === file.name && f.size === file
                        .size);
                    if (!existingFile) {
                        selectedFiles.push(file);

                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const colDiv = document.createElement('div');
                            colDiv.className = 'col-md-3 mb-3';
                            colDiv.id = 'file_' + selectedFiles.length;

                            colDiv.innerHTML = `
                                <div class="card">
                                    <img src="${e.target.result}" class="card-img-top" style="height: 150px; object-fit: cover;">
                                    <div class="card-body p-2">
                                        <small class="card-text text-truncate d-block">${file.name}</small>
                                        <small class="text-muted">(${(file.size / 1024).toFixed(2)} KB)</small>
                                        <button type="button" class="btn btn-sm btn-outline-danger btn-block mt-2 remove-image" 
                                                data-filename="${file.name}" data-filesize="${file.size}">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </div>
                                </div>
                            `;

                            imageList.appendChild(colDiv);
                        };
                        reader.readAsDataURL(file);
                    }
                }
            });

            // Reset input file untuk memungkinkan upload file yang sama lagi
            this.value = '';
        });

        // Remove image
        document.addEventListener('click', function(e) {
            if (e.target.closest('.remove-image')) {
                const button = e.target.closest('.remove-image');
                const fileName = button.dataset.filename;
                const fileSize = parseInt(button.dataset.filesize);

                // Hapus dari array
                selectedFiles = selectedFiles.filter(file =>
                    !(file.name === fileName && file.size === fileSize)
                );

                // Hapus dari tampilan
                e.target.closest('.col-md-3').remove();
            }
        });

        document.getElementById('pengaduanForm').addEventListener('submit', function(e) {
            // Buat DataTransfer baru
            const dataTransfer = new DataTransfer();

            // Tambahkan semua file yang dipilih ke DataTransfer
            selectedFiles.forEach(file => {
                dataTransfer.items.add(file);
            });

            // Buat input file baru dan ganti yang lama
            const newFileInput = document.createElement('input');
            newFileInput.type = 'file';
            newFileInput.name = 'files[]';
            newFileInput.multiple = true;
            newFileInput.files = dataTransfer.files;
            newFileInput.style.display = 'none';

            // Ganti input file lama dengan yang baru
            const oldFileInput = document.getElementById('fileInput');
            oldFileInput.parentNode.insertBefore(newFileInput, oldFileInput);
            oldFileInput.remove();

            // Hapus id dari input baru (opsional)
            newFileInput.removeAttribute('id');

        });
    </script>
@endsection
@endsection
