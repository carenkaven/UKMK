@extends('layouts.admin')

@section('content')
    <div class="card border-0 shadow-sm rounded-4">
        <div
            class="card-header bg-white py-3 border-bottom-0 d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div>
                <h5 class="mb-1 fw-bold">Data Sub Kriteria</h5>
                <p class="text-muted small mb-0">Kelola rincian sub-kriteria.</p>
            </div>
            <a href="{{ route('admin.subkriteria.create') }}" class="btn btn-primary btn-sm shadow-sm">
                <i class="bi bi-plus-lg me-1"></i> Tambah Sub Kriteria
            </a>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" style="border-collapse: separate; border-spacing: 0;">
                    <thead class="bg-light">
                        <tr>
                            <th class="border-0 py-3 ps-4" style="width: 50px;">No</th>
                            <th class="border-0 py-3">Nama Kriteria</th>
                            <th class="border-0 py-3">Nama Sub Kriteria</th>
                            <th class="border-0 py-3">Nilai</th>
                            <th class="border-0 py-3 pe-4 text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($subkriterias as $sub)
                            <tr>
                                <td class="ps-4 fw-medium text-muted">{{ $loop->iteration }}</td>
                                <td class="fw-bold text-dark">{{ $sub->kriteria->nama_kriteria ?? '-' }}</td>
                                <td>{{ $sub->nama_sub }}</td>
                                <td><span class="badge bg-light text-dark border">{{ $sub->nilai }}</span></td>
                                <td class="pe-4 text-end">
                                    <div class="btn-group">
                                        <a href="{{ route('admin.subkriteria.edit', $sub->id_sub_kriteria) }}"
                                            class="btn btn-sm btn-light text-primary" data-bs-toggle="tooltip" title="Edit">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('admin.subkriteria.destroy', $sub->id_sub_kriteria) }}"
                                            method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-light text-danger"
                                                data-bs-toggle="tooltip" title="Hapus">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection