@extends('layouts.app')
@section('title', 'Data Pengaduan')

@section('content')
<div class="card shadow-sm">
    <div class="card-body">
        <a href="{{ route('pengaduan.create') }}" class="btn btn-primary mb-3">+ Tambah Pengaduan</a>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nomor Tiket</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Status</th>
                    <th>Lokasi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pengaduan as $i => $row)
                    <tr>
                        <td>{{ $i+1 }}</td>
                        <td>{{ $row->nomor_tiket }}</td>
                        <td>{{ $row->judul }}</td>
                        <td>{{ $row->kategori->nama ?? '-' }}</td>
                        <td>{{ ucfirst($row->status) }}</td>
                        <td>{{ $row->lokasi_text }}</td>
                        <td>
                            <a href="{{ route('pengaduan.edit', $row->pengaduan_id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('pengaduan.destroy', $row->pengaduan_id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button onclick="return confirm('Yakin hapus data ini?')" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="text-center">Belum ada data</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
