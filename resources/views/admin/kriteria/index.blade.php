@extends('layouts.admin')

@section('content')
    <div class="card border-0 shadow-sm rounded-4">
        <!-- Print Header (Visible only in print) -->
        <div class="d-none d-print-block text-center mb-4">
            <h2 class="h4 fw-bold">INSTITUT TEKNOLOGI NASIONAL MALANG</h2>
            <p class="mb-2">Jalan Bendungan Sigura-gura No. 2 Malang, Jawa Timur</p>
            <hr class="border-dark">
            <h3 class="h5 fw-bold mt-3">LAPORAN DATA KRITERIA DAN SUB KRITERIA</h3>
        </div>

        <div
            class="card-header bg-white py-3 border-bottom-0 d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div>
                <h5 class="mb-1 fw-bold">Manajemen Kriteria & Sub Kriteria (SPK)</h5>
                <p class="text-muted small mb-0">Kelola kriteria dan sub-kriteria untuk sistem penilaian.</p>
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
                        <li><a class="dropdown-item" href="{{ route('admin.kriteria.exportPdf') }}" target="_blank"><i
                                    class="bi bi-file-pdf me-2 text-danger"></i>Export PDF</a></li>
                    </ul>
                </div>
                <a href="{{ route('admin.kriteria.create') }}" class="btn btn-primary btn-sm shadow-sm">
                    <i class="bi bi-plus-lg me-1"></i> Tambah Kriteria
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
                            <th class="border-0 py-3 ps-4" style="width: 5%;">No</th>
                            <th class="border-0 py-3" style="width: 25%;">Nama Kriteria</th>
                            <th class="border-0 py-3" style="width: 15%;">Bobot</th>
                            <th class="border-0 py-3" style="width: 40%;">Sub Kriteria & Nilai</th>
                            <th class="border-0 py-3 pe-4 text-end" style="width: 15%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kriterias as $key => $kriteria)
                            <tr>
                                <td class="ps-4 fw-medium text-muted">{{ $key + 1 }}</td>
                                <td class="fw-bold text-dark">{{ $kriteria->nama_kriteria }}</td>
                                <td><span
                                        class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 rounded-pill">{{ $kriteria->bobot }}%</span>
                                </td>
                                <td>
                                    @if($kriteria->subkriteria->count() > 0)
                                        <div class="d-flex flex-column gap-2">
                                            @foreach($kriteria->subkriteria as $sub)
                                                <div
                                                    class="d-flex align-items-center justify-content-between p-2 rounded bg-light border border-secondary border-opacity-10">
                                                    <span class="small fw-medium">{{ $sub->nama_sub }}</span>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <span class="badge bg-white text-dark border shadow-sm">{{ $sub->nilai }}</span>
                                                        <a href="{{ route('admin.subkriteria.edit', $sub->id_sub_kriteria) }}"
                                                            class="text-warning no-print" data-bs-toggle="tooltip"
                                                            title="Edit Sub Kriteria">
                                                            <i class="bi bi-pencil-square"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="text-muted small fst-italic">Belum ada sub kriteria</div>
                                    @endif
                                    <div class="mt-2 no-print">
                                        <a href="{{ route('admin.subkriteria.create', ['kriteria_id' => $kriteria->id_kriteria]) }}"
                                            class="btn btn-sm btn-outline-primary w-100 border-dashed">
                                            <i class="bi bi-plus-circle me-1"></i> Tambah Sub Kriteria
                                        </a>
                                    </div>
                                </td>
                                <td class="pe-4 text-end">
                                    <div class="btn-group">
                                        <a href="{{ route('admin.kriteria.edit', $kriteria->id_kriteria) }}"
                                            class="btn btn-sm btn-light text-primary" data-bs-toggle="tooltip"
                                            title="Edit Kriteria">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('admin.kriteria.destroy', $kriteria->id_kriteria) }}"
                                            method="POST" class="d-inline"
                                            onsubmit="return confirm('Yakin ingin menghapus kriteria ini?');">
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