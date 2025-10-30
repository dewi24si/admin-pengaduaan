@extends('layouts.app')

@section('title', 'Kategori Pengaduan')
@section('page_title', 'Kategori Pengaduan')

@section('content')
<div class="card shadow-sm">
    <div class="card-body">
        <h5 class="mb-3">Daftar Kategori Pengaduan</h5>

        <a href="{{ route('kategori.create') }}" class="btn btn-primary mb-3">+ Tambah Kategori</a>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th>Nama</th>
                    <th>SLA (Hari)</th>
                    <th>Prioritas</th>
                    <th width="20%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kategori as $i => $row)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $row->nama }}</td>
                        <td>{{ $row->sla_hari }}</td>
                        <td>{{ ucfirst($row->prioritas) }}</td>
                        <td>
                            <a href="{{ route('kategori.edit', $row->kategori_id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('kategori.destroy', $row->kategori_id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Yakin hapus data ini?')" class="btn btn-sm btn-danger">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Belum ada data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-3">
            {{ $kategori->links() }}
        </div>
    </div>
</div>
@endsection
