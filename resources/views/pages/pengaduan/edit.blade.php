@extends('layouts.app')
@section('title', 'Edit Pengaduan')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-warning text-dark">
            <h5 class="mb-0"><i class="bi bi-pencil me-2"></i>Edit Pengaduan</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('pengaduan.update', $pengaduan->pengaduan_id) }}" method="POST"
                enctype="multipart/form-data" id="pengaduanForm">
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

                <!-- EXISTING MEDIA FILES SECTION -->
                @if ($mediaFiles && $mediaFiles->count() > 0)
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h6 class="mb-0">
                                <i class="bi bi-images me-2"></i>Foto/Cover Berita yang Sudah Diupload
                                <small class="text-muted">(Total: {{ $mediaFiles->count() }} foto)</small>
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach ($mediaFiles as $media)
                                    <div class="col-md-3 mb-3">
                                        <div class="card">
                                            <img src="{{ $media->file_url }}" class="card-img-top"
                                                style="height: 150px; object-fit: cover;">
                                            <div class="card-body p-2">
                                                <small
                                                    class="card-text text-truncate d-block">{{ $media->caption ?? $media->file_name }}</small>
                                                <div class="mt-2 d-flex gap-1">
                                                    <a href="{{ $media->file_url }}" target="_blank"
                                                        class="btn btn-sm btn-outline-primary flex-fill">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                    <a href="{{ $media->file_url }}" download
                                                        class="btn btn-sm btn-outline-success flex-fill">
                                                        <i class="bi bi-download"></i>
                                                    </a>
                                                    <button type="button"
                                                        class="btn btn-sm btn-outline-danger flex-fill delete-media-btn"
                                                        data-media-id="{{ $media->media_id }}"
                                                        data-media-name="{{ $media->file_name }}">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Hidden input untuk menyimpan media yang akan dihapus -->
                            <input type="hidden" name="delete_media" id="deleteMediaInput">

                            <div class="form-text mt-2">
                                <i class="bi bi-info-circle me-1"></i>
                                Klik tombol <i class="bi bi-trash text-danger"></i> untuk menghapus foto.
                                Foto disimpan di tabel media dengan:
                                <br>
                                <strong>ref_table:</strong> 'pengaduan' |
                                <strong>ref_id:</strong> {{ $pengaduan->pengaduan_id }}
                            </div>
                        </div>
                    </div>
                @endif

                <!-- NEW FILE UPLOAD SECTION -->
                <div class="card mb-4">
                    <div class="card-header bg-light">
                        <h6 class="mb-0">
                            <i class="bi bi-cloud-upload me-2"></i>Tambah Foto Baru
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Pilih Foto Baru</label>
                            <input type="file" name="files[]" id="fileInput"
                                class="form-control @error('files.*') is-invalid @enderror" multiple
                                accept=".jpg,.jpeg,.png,.gif">
                            @error('files.*')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Dapat menambahkan lebih dari satu foto baru sebagai cover/ilustrasi
                                berita.</small>
                        </div>

                        <!-- File Preview Area -->
                        <div class="file-preview-area mt-3" id="filePreview">
                            <p class="text-muted mb-2">Pratinjau foto baru:</p>
                            <div class="row" id="imageList"></div>
                        </div>
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

@section('scripts')
    <script>
        // Array untuk menyimpan file baru
        let selectedFiles = [];
        // Array untuk menyimpan media yang akan dihapus
        let mediaToDelete = [];

        // Image Preview Script untuk file baru
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

        // Remove image baru
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

        // Handle delete media yang sudah ada
        document.addEventListener('click', function(e) {
            if (e.target.closest('.delete-media-btn')) {
                const button = e.target.closest('.delete-media-btn');
                const mediaId = button.dataset.mediaId;
                const mediaName = button.dataset.mediaName;

                if (confirm(`Apakah Anda yakin ingin menghapus file "${mediaName}"?`)) {
                    // Tambahkan ke array media yang akan dihapus
                    if (!mediaToDelete.includes(mediaId)) {
                        mediaToDelete.push(mediaId);
                    }

                    // Update hidden input
                    document.getElementById('deleteMediaInput').value = mediaToDelete.join(',');

                    // Beri efek visual bahwa file akan dihapus
                    const card = button.closest('.card');
                    card.style.opacity = '0.5';
                    card.style.border = '2px solid #dc3545';

                    // Nonaktifkan tombol
                    button.disabled = true;
                    button.innerHTML = '<i class="bi bi-check"></i> Akan dihapus';

                    alert('File akan dihapus saat Anda menyimpan perubahan.');
                }
            }
        });

        // BEFORE SUBMIT - Update input file dengan file baru
        document.getElementById('pengaduanForm').addEventListener('submit', function(e) {
            // Update hidden input untuk media yang akan dihapus
            document.getElementById('deleteMediaInput').value = mediaToDelete.join(',');

            // Buat DataTransfer baru untuk file baru
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

            // Hapus id dari input baru
            newFileInput.removeAttribute('id');
        });
    </script>
@endsection
@endsection
