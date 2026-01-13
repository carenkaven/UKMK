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
                LAPORAN DATA MAHASISWA UKM</h4>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4 d-print-none">
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
                            <th class="border-0 py-3">Email</th>
                            <th class="border-0 py-3 pe-4 text-end">Aksi</th>
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
                                <td class="text-muted">{{ $mhs->email }}</td>
                                <td class="pe-4 text-end">
                                    <div class="btn-group">
                                        <a href="{{ route('admin.mahasiswa.edit', $mhs->id_mahasiswa) }}"
                                            class="btn btn-sm btn-light text-primary" data-bs-toggle="tooltip" title="Edit">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('admin.mahasiswa.destroy', $mhs->id_mahasiswa) }}"
                                            method="POST" class="d-inline"
                                            onsubmit="return confirm('Yakin ingin menghapus Mahasiswa ini? Semua data terkait (Pendaftaran, Penilaian, Ranking) akan ikut terhapus.');">
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

    <!-- Print-Only Table (Clean Layout) -->
    <div class="d-none d-print-block">
        <table style="width: 100%; border-collapse: collapse; margin-top: 10px; font-family: 'Times New Roman', Times, serif; font-size: 12px; color: black;">
            <thead>
                <tr>
                    <th style="border: 1px solid #000; padding: 6px 8px; background-color: #f0f0f0; text-align: center; font-weight: bold; width: 5%; color: black;">No</th>
                    <th style="border: 1px solid #000; padding: 6px 8px; background-color: #f0f0f0; text-align: center; font-weight: bold; width: 10%; color: black;">Foto</th>
                    <th style="border: 1px solid #000; padding: 6px 8px; background-color: #f0f0f0; text-align: center; font-weight: bold; width: 15%; color: black;">NIM</th>
                    <th style="border: 1px solid #000; padding: 6px 8px; background-color: #f0f0f0; text-align: center; font-weight: bold; color: black;">Nama Mahasiswa</th>
                    <th style="border: 1px solid #000; padding: 6px 8px; background-color: #f0f0f0; text-align: center; font-weight: bold; width: 15%; color: black;">UKM</th>
                    <th style="border: 1px solid #000; padding: 6px 8px; background-color: #f0f0f0; text-align: center; font-weight: bold; width: 15%; color: black;">Prodi</th>
                    <th style="border: 1px solid #000; padding: 6px 8px; background-color: #f0f0f0; text-align: center; font-weight: bold; width: 10%; color: black;">Angkatan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($mahasiswas as $key => $mhs)
                    <tr>
                        <td style="border: 1px solid #000; padding: 6px 8px; text-align: center; color: black;">{{ $key + 1 }}</td>
                        <td style="border: 1px solid #000; padding: 6px 8px; text-align: center; vertical-align: middle;">
                             @if($mhs->foto)
                                <img src="{{ asset('storage/' . $mhs->foto) }}" alt="Foto" style="width: 30px; height: 40px; object-fit: cover; border: 1px solid #000;">
                            @else
                                -
                            @endif
                        </td>
                        <td style="border: 1px solid #000; padding: 6px 8px; text-align: center; color: black;">{{ $mhs->nim }}</td>
                        <td style="border: 1px solid #000; padding: 6px 8px; color: black;">{{ $mhs->nama }}</td>
                         <td style="border: 1px solid #000; padding: 6px 8px; color: black;">
                            @foreach($mhs->pendaftaran as $p)
                                @if($p->status_verifikasi == 'Diterima' && $p->ukm)
                                    <div>{{ $p->ukm->nama_ukm }}</div>
                                @endif
                            @endforeach
                        </td>
                        <td style="border: 1px solid #000; padding: 6px 8px; color: black;">{{ $mhs->prodi }}</td>
                        <td style="border: 1px solid #000; padding: 6px 8px; text-align: center; color: black;">{{ $mhs->angkatan }}</td>
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