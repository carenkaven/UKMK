@extends('layouts.admin')

@section('content')
    <!-- Print-Only Header (KOP SURAT) -->
    @php
        $path = public_path('assets/images/logo-itn.png');
        $logoBase64 = '';
        if (file_exists($path)) {
            try {
                $type = pathinfo($path, PATHINFO_EXTENSION);
                $data = file_get_contents($path);
                $logoBase64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
            } catch (\Exception $e) {
                $logoBase64 = '';
            }
        }
    @endphp
    <div class="d-none d-print-block">
        <div class="header-kop"
            style="display: table; width: 100%; border-bottom: 3px double #000; padding-bottom: 10px; margin-bottom: 20px;">
            <div class="header-logo" style="display: table-cell; width: 15%; vertical-align: middle; text-align: center;">
                <img src="{{ $logoBase64 }}" alt="Logo ITN" style="width: 80px; height: auto;">
            </div>
            <div class="header-text" style="display: table-cell; width: 85%; text-align: center; vertical-align: middle;">
                <h3 style="margin: 0; font-size: 16px; font-weight: bold; text-transform: uppercase; color: black;">
                    PERKUMPULAN PENGELOLA PENDIDIKAN UMUM DAN TEKNOLOGI</h3>
                <h2 style="margin: 0; font-size: 20px; font-weight: bold; text-transform: uppercase; color: #000;">INSTITUT
                    TEKNOLOGI NASIONAL MALANG</h2>
                <h3 style="margin: 0; font-size: 16px; font-weight: bold; text-transform: uppercase; color: black;">FAKULTAS
                    TEKNOLOGI INDUSTRI</h3>
                <p style="margin: 2px 0; font-size: 11px; color: black;">Jalan Bendungan Sigura-gura No. 2 Telp. (0341)
                    551431 Fax. (0341) 553015 Malang 65145</p>
                <p style="margin: 2px 0; font-size: 11px; color: black;">Website: www.itn.ac.id | Email: ftiteknik@itn.ac.id
                </p>
            </div>
        </div>
        <div class="text-center mb-4">
            <h4
                style="margin: 0; text-transform: uppercase; text-decoration: underline; font-size: 14px; font-weight: bold; color: black;">
                LAPORAN HASIL REKOMENDASI ATLET<br>METODE SIMPLE ADDITIVE WEIGHTING (SAW)</h4>
        </div>
    </div>

    <!-- Screen-Only Card -->
    <div class="card border-0 shadow-sm rounded-4 d-print-none">
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
    </div>

    <!-- Content (Screen & Print) -->
    <div class="card border-0 shadow-none bg-transparent">
        <div class="card-body p-0">
            <!-- Screen Table -->
            <div class="table-responsive d-print-none">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="py-3 ps-4 text-center" style="width: 10%;">Ranking</th>
                            <th class="py-3">Nama Atlet</th>
                            <th class="py-3">UKM</th>
                            <th class="py-3">NIM</th>
                            <th class="py-3">Prodi</th>
                            <th class="py-3 text-center">Total Skor</th>
                            <th class="py-3 pe-4 text-center">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rankings as $index => $rank)
                            <tr class="@if($index < 3) bg-primary bg-opacity-10 @endif">
                                <td class="ps-4 text-center">
                                    <span class="fs-5">
                                        @if($index == 0) 🥇
                                        @elseif($index == 1) 🥈
                                        @elseif($index == 2) 🥉
                                        @else <span class="badge bg-light text-secondary border rounded-pill"
                                            style="min-width: 30px;">{{ $index + 1 }}</span>
                                        @endif
                                    </span>
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
                                <td class="text-center fw-bold text-primary">
                                    {{ number_format($rank['total_skor'], 3) }}
                                </td>
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

            <!-- Print-Only Table (Exact Match to PDF) -->
            <div class="d-none d-print-block">
                <table style="width: 100%; border-collapse: collapse; margin-top: 10px; font-family: 'Times New Roman', Times, serif; font-size: 12px; color: black;">
                    <thead>
                        <tr>
                            <th style="border: 1px solid #000; padding: 6px 8px; background-color: #f0f0f0; text-align: center; font-weight: bold; width: 5%; color: black;">No</th>
                            <th style="border: 1px solid #000; padding: 6px 8px; background-color: #f0f0f0; text-align: center; font-weight: bold; color: black;">Nama Mahasiswa</th>
                            <th style="border: 1px solid #000; padding: 6px 8px; background-color: #f0f0f0; text-align: center; font-weight: bold; width: 20%; color: black;">NIM</th>
                            <th style="border: 1px solid #000; padding: 6px 8px; background-color: #f0f0f0; text-align: center; font-weight: bold; width: 20%; color: black;">Prodi</th>
                            <th style="border: 1px solid #000; padding: 6px 8px; background-color: #f0f0f0; text-align: center; font-weight: bold; width: 15%; color: black;">Total Skor</th>
                            <th style="border: 1px solid #000; padding: 6px 8px; background-color: #f0f0f0; text-align: center; font-weight: bold; width: 15%; color: black;">Ranking</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rankings as $index => $rank)
                            <tr>
                                <td style="border: 1px solid #000; padding: 6px 8px; text-align: center; color: black;">{{ $index + 1 }}</td>
                                <td style="border: 1px solid #000; padding: 6px 8px; color: black;">{{ $rank['mahasiswa']->nama }}</td>
                                <td style="border: 1px solid #000; padding: 6px 8px; text-align: center; color: black;">{{ $rank['mahasiswa']->nim }}</td>
                                <td style="border: 1px solid #000; padding: 6px 8px; color: black;">{{ $rank['mahasiswa']->prodi }}</td>
                                <td style="border: 1px solid #000; padding: 6px 8px; text-align: start; font-weight: bold; color: black;">{{ number_format($rank['total_skor'], 3) }}</td>
                                <td style="border: 1px solid #000; padding: 6px 8px; text-align: center; color: black;">
                                    @if($index < 3)
                                         Juara {{ $index + 1 }}
                                    @else
                                         {{ $index + 1 }}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Print-Only Signature -->
    <div class="d-none d-print-block mt-5">
        <div style="width: 100%; display: table; break-inside: avoid;">
            <div style="display: table-cell; width: 40%; text-align: center; padding-left: 60%;">
                <p class="mb-1">Malang, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
                <p class="mb-1">Mengetahui,</p>
                <p class="mb-5">Kepala Bagian Kemahasiswaan</p>
                <br><br>
                <p class="fw-bold text-decoration-underline mb-0">(..................................................)</p>
                <p>NIP. ....................................</p>
            </div>
        </div>
    </div>

    <style>
        @media print {
            @page {
                size: portrait;
                margin: 1cm;
            }

            body {
                font-family: 'Times New Roman', Times, serif;
                color: black;
                background: white;
            }

            .no-print,
            .d-print-none {
                display: none !important;
            }

            .d-print-block {
                display: block !important;
            }

            .d-print-inline {
                display: inline !important;
            }

            .card {
                border: none !important;
                box-shadow: none !important;
            }

            .bg-light {
                background-color: #f8f9fa !important;
                -webkit-print-color-adjust: exact;
            }

            a {
                text-decoration: none;
                color: black;
            }

            table {
                width: 100% !important;
                border-collapse: collapse !important;
            }

            th,
            td {
                border: 1px solid #000 !important;
                padding: 5px !important;
            }

            th {
                background-color: #f0f0f0 !important;
                -webkit-print-color-adjust: exact;
            }
        }
    </style>
@endsection