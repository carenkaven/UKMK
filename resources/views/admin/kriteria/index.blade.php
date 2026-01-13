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
                LAPORAN DATA KRITERIA DAN SUB KRITERIA</h4>
        </div>
    </div>

    <!-- Screen Content -->
    <div class="card border-0 shadow-sm rounded-4 d-print-none">
        
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

    <!-- Print-Only Table -->
    <div class="d-none d-print-block">
        <table style="width: 100%; border-collapse: collapse; margin-top: 10px; font-family: 'Times New Roman', Times, serif; font-size: 12px; color: black;">
            <thead>
                <tr>
                    <th style="border: 1px solid #000; padding: 6px 8px; background-color: #f0f0f0; text-align: center; font-weight: bold; width: 5%; color: black;">No</th>
                    <th style="border: 1px solid #000; padding: 6px 8px; background-color: #f0f0f0; text-align: center; font-weight: bold; color: black;">Nama Kriteria</th>
                    <th style="border: 1px solid #000; padding: 6px 8px; background-color: #f0f0f0; text-align: center; font-weight: bold; width: 10%; color: black;">Bobot</th>
                    <th style="border: 1px solid #000; padding: 6px 8px; background-color: #f0f0f0; text-align: center; font-weight: bold; width: 50%; color: black;">Sub Kriteria</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kriterias as $key => $kriteria)
                    <tr>
                        <td style="border: 1px solid #000; padding: 6px 8px; text-align: center; color: black;">{{ $key + 1 }}</td>
                        <td style="border: 1px solid #000; padding: 6px 8px; color: black;">{{ $kriteria->nama_kriteria }}</td>
                        <td style="border: 1px solid #000; padding: 6px 8px; text-align: center; color: black;">{{ $kriteria->bobot }}%</td>
                        <td style="border: 1px solid #000; padding: 6px 8px; color: black;">
                            @if($kriteria->subkriteria->count() > 0)
                                <ul style="margin: 0; padding-left: 20px;">
                                    @foreach($kriteria->subkriteria as $sub)
                                        <li>{{ $sub->nama_sub }} (nilai: {{ $sub->nilai }})</li>
                                    @endforeach
                                </ul>
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Print-Only Signature -->
        <div class="signature-section mt-5" style="width: 100%; display: table; break-inside: avoid;">
            <div class="signature-box" style="display: table-cell; width: 40%; text-align: center; padding-left: 60%;">
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
            @page { size: portrait; margin: 1cm; }
            body { font-family: 'Times New Roman', Times, serif; color: black; background: white; }
            .no-print, .d-print-none { display: none !important; }
            .d-print-block { display: block !important; }
            .card { border: none !important; box-shadow: none !important; }
            a { text-decoration: none; color: black; }
             /* Reset Bootstrap Table Styles for Print */
            table { width: 100% !important; border-collapse: collapse !important; background-color: transparent !important; }
            th, td { border: 1px solid #000 !important; padding: 5px !important; background-color: transparent !important; color: black !important; }
            th { background-color: #f0f0f0 !important; -webkit-print-color-adjust: exact; }
        }
    </style>
@endsection