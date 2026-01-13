@extends('layouts.admin')

@section('content')
    <div class="card border-0 shadow-sm rounded-4">
        <!-- Print Header -->
        <div class="d-none d-print-block text-center mb-4">
            <h2 class="h4 fw-bold">INSTITUT TEKNOLOGI NASIONAL MALANG</h2>
            <p class="mb-2">Jalan Bendungan Sigura-gura No. 2 Malang, Jawa Timur</p>
            <hr class="border-dark">
            <h3 class="h5 fw-bold mt-3">LAPORAN HASIL REKOMENDASI ATLET (SPK)</h3>
        </div>

        <div
            class="card-header bg-white py-3 border-bottom-0 d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div>
                <h5 class="mb-1 fw-bold">Hasil Rekomendasi Atlet</h5>
                <p class="text-muted small mb-0">Peringkat atlet berdasarkan perhitungan metode SAW.</p>
            </div>

            <div class="d-flex gap-2 no-print">
                <a href="{{ route('admin.penilaian.index') }}" class="btn btn-outline-secondary btn-sm shadow-sm">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
                <div class="dropdown">
                    <button class="btn btn-primary btn-sm dropdown-toggle shadow-sm" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="bi bi-printer me-1"></i> Cetak / Export
                    </button>
                    <ul class="dropdown-menu shadow-sm border-0">
                        <li><button class="dropdown-item" onclick="window.print()"><i class="bi bi-printer me-2"></i>Cetak
                                (Browser)</button></li>
                        <li><a class="dropdown-item" href="{{ route('admin.penilaian.exportPdf') }}" target="_blank"><i
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
                            <th class="border-0 py-3 ps-4 text-center" style="width: 10%;">Ranking</th>
                            <th class="border-0 py-3">Nama Atlet</th>
                            <th class="border-0 py-3">UKM</th>
                            <th class="border-0 py-3">NIM</th>
                            <th class="border-0 py-3">Prodi</th>
                            <th class="border-0 py-3 text-center">Total Skor</th>
                            <th class="border-0 py-3 pe-4 text-center">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rankings as $index => $rank)
                            <tr class="@if($index < 3) bg-primary bg-opacity-10 @endif">
                                <td class="ps-4 text-center">
                                    @if($index == 0)
                                        <span class="fs-4">🥇</span>
                                    @elseif($index == 1)
                                        <span class="fs-4">🥈</span>
                                    @elseif($index == 2)
                                        <span class="fs-4">🥉</span>
                                    @else
                                        <span class="badge bg-light text-secondary border rounded-pill"
                                            style="min-width: 30px;">{{ $index + 1 }}</span>
                                    @endif
                                </td>
                                <td class="fw-bold text-dark">{{ $rank['mahasiswa']->nama }}</td>
                                <td>
                                    @foreach($rank['mahasiswa']->pendaftaran as $pendaftaran)
                                        @if($pendaftaran->status_verifikasi == 'Diterima' && $pendaftaran->ukm)
                                            <span
                                                class="badge bg-info bg-opacity-10 text-info border border-info border-opacity-25 rounded-pill fw-normal">{{ $pendaftaran->ukm->nama_ukm }}</span>
                                        @endif
                                    @endforeach
                                </td>
                                <td class="text-muted">{{ $rank['mahasiswa']->nim }}</td>
                                <td class="text-muted">{{ $rank['mahasiswa']->prodi }}</td>
                                <td class="text-center fw-bold text-primary">{{ number_format($rank['total_skor'], 3) }}</td>
                                <td class="pe-4 text-center">
                                    @if($index < 3)
                                        <span class="badge bg-success shadow-sm">Sangat Direkomendasikan</span>
                                    @else
                                        <span class="badge bg-secondary">Dipertimbangkan</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">Belum ada data penilaian untuk dihitung.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection