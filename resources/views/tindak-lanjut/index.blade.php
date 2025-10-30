@extends('layouts.app')

@section('title', 'Daftar Tindak Lanjut')
@section('page_title', 'Data Tindak Lanjut')

@section('content')
<div class="card shadow-sm">
    <div class="card-body">
        <a href="{{ route('tindak.create') }}" class="btn btn-primary mb-3">+ Tambah Data</a>

        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Kategori Pengaduan</th>
                    <th>Petugas</th>
                    <th>Aksi</th>
                    <th>Catatan</th>
                    <th>Foto</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tindakLanjut as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->kategori_pengaduan }}</td>
                        <td>{{ $item->petugas }}</td>
                        <td>{{ $item->aksi }}</td>
                        <td>{{ $item->catatan ?? '-' }}</td>
                        <td>
                            @if ($item->foto)
                                <img src="{{ asset('storage/'.$item->foto) }}" alt="Foto" width="80">
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('tindak.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">Belum ada data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
