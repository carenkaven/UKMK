@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card">
            <!-- Print Header -->
            <div class="print-header">
                <h2>INSTITUT TEKNOLOGI NASIONAL MALANG</h2>
                <p>Jalan Bendungan Sigura-gura No. 2 Malang, Jawa Timur</p>
                <hr>
                <h3>LAPORAN HASIL REKOMENDASI ATLET (SPK)</h3>
            </div>

            <div class="header-flex no-print">
                <h3>Hasil Rekomendasi Atlet</h3>
                <div class="dropdown">
                    <button class="btn btn-secondary">🖨️ Cetak / Export ▼</button>
                    <div class="dropdown-content">
                        <button onclick="window.print()">🖨️ Cetak (Browser)</button>
                        <a href="{{ route('admin.penilaian.exportPdf') }}" target="_blank">📄 Export PDF</a>
                    </div>
                </div>
            </div>

            <div style="margin-bottom: 20px;" class="no-print">
                <a href="{{ route('admin.penilaian.index') }}" class="btn btn-sm btn-secondary">&laquo; Kembali ke Data
                    Penilaian</a>
            </div>

            <div class="table-responsive">
                <table class="admin-table ranking-table">
                    <thead>
                        <tr>
                            <th style="width: 10%;">Ranking</th>
                            <th>Nama Atlet</th>
                            <th>UKM</th>
                            <th>NIM</th>
                            <th>Prodi</th>
                            <th>Total Skor</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rankings as $index => $rank)
                            <tr style="{{ $index < 3 ? 'background-color: #f0f8ff;' : '' }}">
                                <td style="text-align:center; font-weight:bold; font-size:1.2em;">
                                    @if($index == 0) 🥇 1
                                    @elseif($index == 1) 🥈 2
                                    @elseif($index == 2) 🥉 3
                                    @else {{ $index + 1 }}
                                    @endif
                                </td>
                                <td><strong>{{ $rank['mahasiswa']->nama }}</strong></td>
                                <td>
                                    @foreach($rank['mahasiswa']->pendaftaran as $pendaftaran)
                                        @if($pendaftaran->status_verifikasi == 'Diterima' && $pendaftaran->ukm)
                                            {{ $pendaftaran->ukm->nama_ukm }}<br>
                                        @endif
                                    @endforeach
                                </td>
                                <td>{{ $rank['mahasiswa']->nim }}</td>
                                <td>{{ $rank['mahasiswa']->prodi }}</td>
                                <td style="font-weight:bold; color:#004aad;">{{ number_format($rank['total_skor'], 1) }}</td>
                                <td>
                                    @if($index < 3)
                                        <span class="badge badge-success">Sangat Direkomendasikan</span>
                                    @else
                                        <span class="badge badge-pending">Dipertimbangkan</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" style="text-align:center;">Belum ada data penilaian untuk dihitung.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <style>
            /* Additional Print Styles for Ranking */
            @media print {
                .badge {
                    border: none !important;
                    color: #000 !important;
                    background: none !important;
                }

                tr[style*="background-color"] {
                    background-color: transparent !important;
                }
            }
        </style>
@endsection