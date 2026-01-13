@extends('layouts.admin')

@section('content')
    <div class="card">
        <!-- Print Header (Visible only in print) -->
        <div class="print-header">
            <h2>INSTITUT TEKNOLOGI NASIONAL MALANG</h2>
            <p>Jalan Bendungan Sigura-gura No. 2 Malang, Jawa Timur</p>
            <hr>
            <h3>LAPORAN HASIL PENILAIAN ATLET (SAW)</h3>
        </div>

        <div class="header-flex no-print">
            <h3>Data Penilaian Atlet</h3>
            <div>
                <button onclick="window.print()" class="btn btn-secondary" style="margin-right: 10px;">🖨️ Cetak
                    Laporan</button>
                <a href="{{ route('admin.penilaian.ranking') }}" class="btn btn-secondary" style="margin-right: 10px;">🏆
                    Lihat Ranking (SPK)</a>
                <a href="{{ route('admin.penilaian.create') }}" class="btn btn-primary">+ Input Nilai Baru</a>
            </div>
        </div>

        @if(session('success'))
            <div
                style="background:#d4edda; color:#155724; padding:15px; border-radius:8px; margin-bottom:20px; border: 1px solid #c3e6cb;">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th style="width: 25%;">Nama Atlet</th>
                        <th style="width: 20%;">UKM</th>
                        <th style="width: 50%;">Detail Penilaian</th>
                        <th style="width: 20%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($penilaians as $id_mahasiswa => $group)
                        @php $mhs = $group->first()->mahasiswa; @endphp
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <strong>{{ $mhs->nama }}</strong><br>
                                <small class="text-muted">{{ $mhs->nim }}</small>
                            </td>
                            <td>
                                @foreach($mhs->pendaftaran as $pendaftaran)
                                    @if($pendaftaran->status_verifikasi == 'Diterima' && $pendaftaran->ukm)
                                        <span class="badge bg-info">{{ $pendaftaran->ukm->nama_ukm }}</span><br>
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                <div class="assessment-details">
                                    @foreach($group as $item)
                                        <div class="assessment-item">
                                            <span class="criteria-label">{{ $item->kriteria->nama_kriteria }}</span>
                                            <span class="criteria-value">
                                                {{ $item->subKriteria->nama_sub }}
                                                <span class="score-badge">{{ $item->nilai }}</span>
                                            </span>
                                        </div>
                                    @endforeach
                                </div>
                            </td>
                            <td>
                                <a href="{{ route('admin.penilaian.create', ['id' => $mhs->id_mahasiswa]) }}"
                                    class="btn btn-sm text-warning" style="margin-right:5px;">Edit</a>
                                <form action="{{ route('admin.penilaian.destroy', $mhs->id_mahasiswa) }}" method="POST"
                                    style="display:inline;"
                                    onsubmit="return confirm('Yakin ingin menghapus semua nilai atlet ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm text-danger" style="background:none;">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" style="text-align:center;">Belum ada data penilaian.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection