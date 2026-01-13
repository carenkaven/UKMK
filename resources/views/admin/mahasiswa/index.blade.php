@extends('layouts.admin')

@section('content')
    <div class="card border-0 shadow-sm rounded-4">
        <!-- Header -->
        <div
            class="card-header bg-white py-3 border-bottom-0 d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div>
                <h5 class="mb-1 fw-bold">Data Mahasiswa UKM</h5>
                <p class="text-muted small mb-0">Daftar semua mahasiswa yang terdaftar dalam sistem.</p>
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
                        <li><a class="dropdown-item" href="{{ route('admin.mahasiswa.exportPdf') }}" target="_blank"><i
                                    class="bi bi-file-pdf me-2 text-danger"></i>Export PDF</a></li>
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
                            <th class="border-0 py-3">Foto</th>
                            <th class="border-0 py-3">NIM</th>
                            <th class="border-0 py-3">Nama</th>
                            <th class="border-0 py-3">UKM</th>
                            <th class="border-0 py-3">Prodi</th>
                            <th class="border-0 py-3">Angkatan</th>
                            <th class="border-0 py-3 pe-4">Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($mahasiswas as $key => $mhs)
                            <tr>
                                <td class="ps-4 fw-medium text-muted">{{ $key + 1 }}</td>
                                <td>
                                    @if($mhs->foto)
                                        <img src="{{ asset('storage/' . $mhs->foto) }}" alt="Foto"
                                            class="rounded-circle shadow-sm object-fit-cover" width="40" height="40">
                                    @else
                                        <div class="rounded-circle bg-light d-flex align-items-center justify-content-center text-muted small fw-bold"
                                            style="width: 40px; height: 40px;">
                                            {{ substr($mhs->nama, 0, 1) }}
                                        </div>
                                    @endif
                                </td>
                                <td class="fw-medium">{{ $mhs->nim }}</td>
                                <td>
                                    <div class="fw-medium text-dark">{{ $mhs->nama }}</div>
                                </td>
                                <td>
                                    @foreach($mhs->pendaftaran as $p)
                                        @if($p->status_verifikasi == 'Diterima' && $p->ukm)
                                            <span
                                                class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 rounded-pill mb-1 d-inline-block fw-normal">
                                                {{ $p->ukm->nama_ukm }}
                                            </span>
                                        @endif
                                    @endforeach
                                    @if($mhs->pendaftaran->where('status_verifikasi', 'Diterima')->isEmpty())
                                        <span class="text-muted small">-</span>
                                    @endif
                                </td>
                                <td>{{ $mhs->prodi }}</td>
                                <td>{{ $mhs->angkatan }}</td>
                                <td class="pe-4 text-muted">{{ $mhs->email }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection