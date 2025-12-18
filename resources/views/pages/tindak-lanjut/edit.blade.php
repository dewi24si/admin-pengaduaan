@extends('layouts.app')
@section('title', 'Edit Tindak Lanjut')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-warning text-dark">
            <h5 class="mb-0"><i class="bi bi-pencil me-2"></i>Edit Tindak Lanjut</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('tindak.update', $tindak->tindak_id) }}" method="POST" enctype="multipart/form-data"
                id="tindakForm">
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

                <!-- EXISTING MEDIA FILES SECTION -->
                @if ($mediaFiles && $mediaFiles->count() > 0)
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h6 class="mb-0">
                                <i class="bi bi-folder me-2"></i>File yang Sudah Diupload
                                <small class="text-muted">(Total: {{ $mediaFiles->count() }} file)</small>
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach ($mediaFiles as $media)
                                    <div class="col-md-4 mb-3">
                                        <div class="card h-100">
                                            <div class="card-body text-center">
                                                <div class="mb-2">
                                                    <i
                                                        class="bi {{ $media->file_icon }} display-4 
                                                        {{ $media->is_image ? 'text-success' : 'text-primary' }}"></i>
                                                </div>
                                                <h6 class="card-title text-truncate">
                                                    {{ $media->caption ?? $media->file_name }}</h6>
                                                <p class="card-text small text-muted">
                                                    {{ strtoupper(pathinfo($media->file_name, PATHINFO_EXTENSION)) }}
                                                    <br>
                                                    <small>{{ $media->created_at->format('d/m/Y') }}</small>
                                                </p>
                                            </div>
                                            <div class="card-footer bg-transparent">
                                                <div class="d-flex justify-content-center gap-2">
                                                    <a href="{{ $media->file_url }}" target="_blank"
                                                        class="btn btn-sm btn-outline-primary">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                    <a href="{{ $media->file_url }}" download
                                                        class="btn btn-sm btn-outline-success">
                                                        <i class="bi bi-download"></i>
                                                    </a>
                                                    <button type="button"
                                                        class="btn btn-sm btn-outline-danger delete-media-btn"
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
                                Klik tombol <i class="bi bi-trash text-danger"></i> untuk menghapus file.
                                File disimpan di tabel media dengan:
                                <br>
                                <strong>ref_table:</strong> 'tindak_lanjut' |
                                <strong>ref_id:</strong> {{ $tindak->tindak_id }}
                            </div>
                        </div>
                    </div>
                @endif

                <!-- NEW FILE UPLOAD SECTION -->
                <div class="card mb-4">
                    <div class="card-header bg-light">
                        <h6 class="mb-0">
                            <i class="bi bi-cloud-upload me-2"></i>Tambah File Baru
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Pilih File Baru</label>
                            <input type="file" name="files[]" id="fileInput"
                                class="form-control @error('files.*') is-invalid @enderror" multiple
                                accept=".jpg,.jpeg,.png,.pdf,.doc,.docx,.xls,.xlsx">
                            @error('files.*')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Dapat menambahkan lebih dari satu file baru.</small>
                        </div>

                        <!-- File Preview Area -->
                        <div class="file-preview-area mt-3" id="filePreview">
                            <p class="text-muted mb-2">Pratinjau file baru:</p>
                            <div class="list-group" id="fileList"></div>
                        </div>
                    </div>
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

@section('scripts')
    <script>
        // Array untuk menyimpan file baru
        let selectedFiles = [];
        // Array untuk menyimpan media yang akan dihapus
        let mediaToDelete = [];

        // File Preview Script untuk file baru
        document.getElementById('fileInput').addEventListener('change', function(e) {
            const fileList = document.getElementById('fileList');

            // Tambahkan file baru ke array
            Array.from(this.files).forEach((file) => {
                // Cek apakah file sudah ada
                const existingFile = selectedFiles.find(f => f.name === file.name && f.size === file.size);
                if (!existingFile) {
                    selectedFiles.push(file);

                    const fileItem = document.createElement('div');
                    fileItem.className =
                        'list-group-item list-group-item-action d-flex justify-content-between align-items-center';
                    fileItem.id = 'file_' + selectedFiles.length;

                    const fileInfo = document.createElement('div');
                    fileInfo.innerHTML = `
                        <i class="bi ${getFileIcon(file)} me-2"></i>
                        <span>${file.name}</span>
                        <small class="text-muted ms-2">(${(file.size / 1024).toFixed(2)} KB)</small>
                    `;

                    const removeBtn = document.createElement('button');
                    removeBtn.type = 'button';
                    removeBtn.className = 'btn btn-sm btn-outline-danger';
                    removeBtn.innerHTML = '<i class="bi bi-x"></i>';
                    removeBtn.dataset.filename = file.name;
                    removeBtn.dataset.filesize = file.size;
                    removeBtn.onclick = function() {
                        const fileName = this.dataset.filename;
                        const fileSize = parseInt(this.dataset.filesize);

                        // Hapus dari array
                        selectedFiles = selectedFiles.filter(f =>
                            !(f.name === fileName && f.size === fileSize)
                        );

                        // Hapus dari tampilan
                        this.closest('.list-group-item').remove();
                    };

                    fileItem.appendChild(fileInfo);
                    fileItem.appendChild(removeBtn);
                    fileList.appendChild(fileItem);
                }
            });

            // Reset input file untuk memungkinkan upload file yang sama lagi
            this.value = '';
        });

        function getFileIcon(file) {
            if (file.type.startsWith('image/')) return 'bi-image';
            if (file.type === 'application/pdf') return 'bi-file-pdf';
            if (file.type.includes('word')) return 'bi-file-word';
            if (file.type.includes('excel')) return 'bi-file-excel';
            if (file.type.includes('powerpoint')) return 'bi-file-ppt';
            return 'bi-file-earmark';
        }

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

        document.getElementById('tindakForm').addEventListener('submit', function(e) {
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
