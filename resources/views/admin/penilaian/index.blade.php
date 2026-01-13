@extends('layouts.admin')

@section('content')
    <div class="card border-0 shadow-sm rounded-4">
        <!-- Print Header (Visible only in print) -->
        <div class="d-none d-print-block text-center mb-4">
            <h2 class="h4 fw-bold">INSTITUT TEKNOLOGI NASIONAL MALANG</h2>
            <p class="mb-2">Jalan Bendungan Sigura-gura No. 2 Malang, Jawa Timur</p>
            <hr class="border-dark">
            <h3 class="h5 fw-bold mt-3">LAPORAN HASIL PENILAIAN ATLET (SAW)</h3>
        </div>

        <div
            class="card-header bg-white py-3 border-bottom-0 d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div>
                <h5 class="mb-1 fw-bold">Data Penilaian Atlet</h5>
                <p class="text-muted small mb-0">Kelola penilaian menggunakan metode SAW.</p>
            </div>

            <div class="d-flex gap-2 no-print">
                <button onclick="window.print()" class="btn btn-outline-secondary btn-sm shadow-sm">
                    <i class="bi bi-printer me-1"></i> Cetak
                </button>
                <a href="{{ route('admin.penilaian.ranking') }}" class="btn btn-success btn-sm shadow-sm text-white">
                    <i class="bi bi-trophy me-1"></i> Lihat Ranking
                </a>
                <a href="{{ route('admin.penilaian.create') }}" class="btn btn-primary btn-sm shadow-sm">
                    <i class="bi bi-plus-lg me-1"></i> Input Nilai
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
                            <th class="border-0 py-3" style="width: 25%;">Nama Atlet</th>
                            <th class="border-0 py-3" style="width: 20%;">UKM</th>
                            <th class="border-0 py-3" style="width: 50%;">Detail Penilaian</th>
                            <th class="border-0 py-3 pe-4 text-end" style="width: 20%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($penilaians as $id_mahasiswa => $group)
                            @php $mhs = $group->first()->mahasiswa; @endphp
                            <tr>
                                <td class="ps-4 fw-medium text-muted">{{ $loop->iteration }}</td>
                                <td>
                                    <div class="fw-bold text-dark">{{ $mhs->nama }}</div>
                                    <small class="text-muted"><i class="bi bi-card-heading me-1"></i>{{ $mhs->nim }}</small>
                                </td>
                                <td>
                                    @foreach($mhs->pendaftaran as $pendaftaran)
                                        @if($pendaftaran->status_verifikasi == 'Diterima' && $pendaftaran->ukm)
                                            <span
                                                class="badge bg-info bg-opacity-10 text-info border border-info border-opacity-25 rounded-pill fw-normal">{{ $pendaftaran->ukm->nama_ukm }}</span><br>
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    <div class="d-flex flex-wrap gap-2">
                                        @foreach($group as $item)
                                            <div class="badge bg-light text-wrap text-start border shadow-sm p-2 w-100"
                                                style="max-width: 100%;">
                                                <div class="text-muted small mb-1">{{ $item->kriteria->nama_kriteria }}</div>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <span class="text-dark fw-medium text-truncate"
                                                        style="max-width: 80%;">{{ $item->subKriteria->nama_sub }}</span>
                                                    <span class="badge bg-primary rounded-pill">{{ $item->nilai }}</span>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="pe-4 text-end">
                                    <div class="btn-group">
                                        <a href="{{ route('admin.penilaian.create', ['id' => $mhs->id_mahasiswa]) }}"
                                            class="btn btn-sm btn-light text-primary" data-bs-toggle="tooltip"
                                            title="Edit Nilai">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('admin.penilaian.destroy', $mhs->id_mahasiswa) }}" method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Yakin ingin menghapus semua nilai atlet ini?');">
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
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">Belum ada data penilaian.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection