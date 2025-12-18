@extends('layouts.app')
@section('title', 'Tambah Tindak Lanjut')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="bi bi-clipboard-check me-2"></i>Tambah Tindak Lanjut</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('tindak.store') }}" method="POST" enctype="multipart/form-data" id="tindakForm">
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
                    <div class="form-text">Hanya menampilkan pengaduan yang belum memiliki tindak lanjut</div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Petugas <span class="text-danger">*</span></label>
                        <input type="text" name="petugas" class="form-control @error('petugas') is-invalid @enderror"
                            value="{{ old('petugas') }}" required placeholder="Masukkan nama petugas">
                        @error('petugas')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Aksi <span class="text-danger">*</span></label>
                        <input type="text" name="aksi" class="form-control @error('aksi') is-invalid @enderror"
                            value="{{ old('aksi') }}" required placeholder="Masukkan aksi yang dilakukan">
                        @error('aksi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Catatan</label>
                    <textarea name="catatan" class="form-control @error('catatan') is-invalid @enderror" rows="4"
                        placeholder="Masukkan catatan tindak lanjut">{{ old('catatan') }}</textarea>
                    @error('catatan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- MULTIPLE FILE UPLOAD SECTION -->
                <div class="card mb-4">
                    <div class="card-header bg-light">
                        <h6 class="mb-0">
                            <i class="bi bi-files me-2"></i>Upload File Pendukung
                            <small class="text-muted">(PDF, DOC, XLS, Gambar)</small>
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Pilih File</label>
                            <input type="file" name="files[]" id="fileInput"
                                class="form-control @error('files.*') is-invalid @enderror" multiple
                                accept=".jpg,.jpeg,.png,.pdf,.doc,.docx,.xls,.xlsx">
                            @error('files.*')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Maksimal 5MB per file. Dapat memilih lebih dari satu file.</small>
                        </div>

                        <!-- File Preview Area -->
                        <div class="file-preview-area mt-3" id="filePreview">
                            <p class="text-muted mb-2">Pratinjau file:</p>
                            <div class="list-group" id="fileList"></div>
                        </div>

                        <!-- Uploaded Files Info -->
                        <div class="alert alert-info mt-3">
                            <i class="bi bi-info-circle me-2"></i>
                            File akan disimpan dalam tabel media dengan:
                            <ul class="mb-0 mt-2">
                                <li>ref_table = 'tindak_lanjut'</li>
                                <li>ref_id = [ID Tindak Lanjut]</li>
                                <li>file_name = [nama file yang diupload]</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('tindak.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Kembali
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-check-circle me-2"></i>Simpan Tindak Lanjut
                    </button>
                </div>
            </form>
        </div>
    </div>

@section('scripts')
    <script>
        // Array untuk menyimpan file
        let selectedFiles = [];

        // File Preview Script
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

        document.getElementById('tindakForm').addEventListener('submit', function(e) {
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
