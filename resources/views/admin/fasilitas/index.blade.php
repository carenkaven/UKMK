@extends('layouts.admin')

@section('content')
    <div class="card border-0 shadow-sm rounded-4">
        <!-- Print Header -->
        <div class="d-none d-print-block text-center mb-4">
            <h2 class="h4 fw-bold">INSTITUT TEKNOLOGI NASIONAL MALANG</h2>
            <p class="mb-2">Jalan Bendungan Sigura-gura No. 2 Malang, Jawa Timur</p>
            <hr class="border-dark">
            <h3 class="h5 fw-bold mt-3">LAPORAN DATA FASILITAS UKM</h3>
        </div>

        <div
            class="card-header bg-white py-3 border-bottom-0 d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div>
                <h5 class="mb-1 fw-bold">Manajemen Fasilitas</h5>
                <p class="text-muted small mb-0">Kelola data fasilitas yang tersedia untuk UKM.</p>
            </div>

            <div class="d-flex gap-2 no-print">
                <div class="dropdown">
                    <button class="btn btn-outline-secondary btn-sm dropdown-toggle shadow-sm" type="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-printer me-1"></i> Cetak / Export
                    </button>
                    <ul class="dropdown-menu shadow-sm border-0">
                        <li><button class="dropdown-item" onclick="window.print()"><i class="bi bi-printer me-2"></i>Cetak
                                (Browser)</button></li>
                        <li><a class="dropdown-item" href="{{ route('admin.fasilitas.exportPdf') }}" target="_blank"><i
                                    class="bi bi-file-pdf me-2 text-danger"></i>Export PDF</a></li>
                    </ul>
                </div>
                <a href="{{ route('admin.fasilitas.create') }}" class="btn btn-primary btn-sm shadow-sm">
                    <i class="bi bi-plus-lg me-1"></i> Tambah Fasilitas
                </a>
            </div>
        </div>

        <div class="card-body p-0">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" style="border-collapse: separate; border-spacing: 0;">
                    <thead class="bg-light">
                        <tr>
                            <th class="border-0 py-3 ps-4" style="width: 50px;">No</th>
                            <th class="border-0 py-3">Nama Fasilitas</th>
                            <th class="border-0 py-3">Deskripsi</th>
                            <th class="border-0 py-3 pe-4 text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($fasilitas as $key => $item)
                            <tr>
                                <td class="ps-4 fw-medium text-muted">{{ $key + 1 }}</td>
                                <td class="fw-medium text-dark">{{ $item->nama_fasilitas }}</td>
                                <td class="text-muted">{{ $item->deskripsi }}</td>
                                <td class="pe-4 text-end">
                                    <div class="btn-group">
                                        <a href="{{ route('admin.fasilitas.edit', $item->id_fasilitas) }}"
                                            class="btn btn-sm btn-light text-primary" data-bs-toggle="tooltip" title="Edit">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('admin.fasilitas.destroy', $item->id_fasilitas) }}" method="POST"
                                            class="d-inline" onsubmit="return confirm('Yakin ingin menghapus fasilitas ini?');">
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