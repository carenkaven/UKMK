@extends('layouts.admin')

@section('content')
    <div class="card border-0 shadow-sm rounded-4">
        <!-- Print Header -->
        <div class="d-none d-print-block text-center mb-4">
            <h2 class="h4 fw-bold">INSTITUT TEKNOLOGI NASIONAL MALANG</h2>
            <p class="mb-2">Jalan Bendungan Sigura-gura No. 2 Malang, Jawa Timur</p>
            <hr class="border-dark">
            <h3 class="h5 fw-bold mt-3">LAPORAN DATA PENDAFTARAN UKM</h3>
        </div>

        <div class="card-header bg-white py-3 border-bottom-0 d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div>
                <h5 class="mb-1 fw-bold">Data Pendaftaran Masuk</h5>
                <p class="text-muted small mb-0">Daftar mahasiswa yang mendaftar ke UKM.</p>
            </div>
            
            <div class="d-flex gap-2 no-print">
                <div class="dropdown">
                    <button class="btn btn-outline-secondary btn-sm dropdown-toggle shadow-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-printer me-1"></i> Cetak / Export
                    </button>
                    <ul class="dropdown-menu shadow-sm border-0">
                        <li><button class="dropdown-item" onclick="window.print()"><i class="bi bi-printer me-2"></i>Cetak (Browser)</button></li>
                        <li><a class="dropdown-item" href="{{ route('admin.pendaftaran.exportPdf') }}" target="_blank"><i class="bi bi-file-pdf me-2 text-danger"></i>Export PDF</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" style="border-collapse: separate; border-spacing: 0;">
                    <thead class="bg-light">
                        <tr>
                            <th class="border-0 py-3 ps-4" style="width: 50px;">No</th>
                            <th class="border-0 py-3">Nama Atlet</th>
                            <th class="border-0 py-3">NIM</th>
                            <th class="border-0 py-3">Prodi</th>
                            <th class="border-0 py-3">UKM Pilihan</th>
                            <th class="border-0 py-3">Tanggal Daftar</th>
                            <th class="border-0 py-3 pe-4">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pendaftarans as $key => $data)
                            <tr>
                                <td class="ps-4 fw-medium text-muted">{{ $key + 1 }}</td>
                                <td class="fw-medium text-dark">{{ $data->mahasiswa->nama }}</td>
                                <td class="text-muted">{{ $data->mahasiswa->nim }}</td>
                                <td>{{ $data->mahasiswa->prodi }}</td>
                                <td>
                                    <span class="badge bg-info bg-opacity-10 text-info border border-info border-opacity-25 rounded-pill fw-normal">
                                        {{ $data->ukm->nama_ukm }}
                                    </span>
                                </td>
                                <td>{{ $data->tanggal_daftar }}</td>
                                <td class="pe-4">
                                    <form action="{{ route('admin.pendaftaran.update', $data->id_pendaftaran) }}" method="POST">
                                        @csrf
                                        <select name="status_verifikasi" onchange="this.form.submit()"
                                            class="form-select form-select-sm border-0 fw-bold shadow-sm {{ $data->status_verifikasi == 'Diterima' ? 'bg-success text-white' : ($data->status_verifikasi == 'Ditolak' ? 'bg-danger text-white' : 'bg-warning text-dark') }}"
                                            style="width: 130px; cursor: pointer;">
                                            <option value="Pending" {{ $data->status_verifikasi == 'Pending' ? 'selected' : '' }}>
                                                Pending</option>
                                            <option value="Diterima" {{ $data->status_verifikasi == 'Diterima' ? 'selected' : '' }}>
                                                Diterima</option>
                                            <option value="Ditolak" {{ $data->status_verifikasi == 'Ditolak' ? 'selected' : '' }}>
                                                Ditolak</option>
                                        </select>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection