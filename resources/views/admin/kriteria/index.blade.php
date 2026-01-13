@extends('layouts.admin')

@section('content')
    <div class="card">
        <!-- Print Header (Visible only in print) -->
        <div class="print-header">
            <h2>INSTITUT TEKNOLOGI NASIONAL MALANG</h2>
            <p>Jalan Bendungan Sigura-gura No. 2 Malang, Jawa Timur</p>
            <hr>
            <h3>LAPORAN DATA KRITERIA DAN SUB KRITERIA</h3>
        </div>

        <div class="header-flex no-print">
            <h3>Manajemen Kriteria & Sub Kriteria (SPK)</h3>
            <div>
                <div class="dropdown">
                    <button class="btn btn-secondary">🖨️ Cetak / Export ▼</button>
                    <div class="dropdown-content">
                        <button onclick="window.print()">🖨️ Cetak (Browser)</button>
                        <a href="{{ route('admin.kriteria.exportPdf') }}" target="_blank">📄 Export PDF</a>
                    </div>
                </div>
                <a href="{{ route('admin.kriteria.create') }}" class="btn btn-primary">+ Tambah Kriteria</a>
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
                        <th style="width: 25%;">Nama Kriteria</th>
                        <th style="width: 15%;">Bobot</th>
                        <th style="width: 40%;">Sub Kriteria & Nilai</th>
                        <th style="width: 15%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kriterias as $key => $kriteria)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td><strong>{{ $kriteria->nama_kriteria }}</strong></td>
                            <td>{{ $kriteria->bobot }}%</td>
                            <td>
                                @if($kriteria->subkriteria->count() > 0)
                                    <div class="assessment-details">
                                        @foreach($kriteria->subkriteria as $sub)
                                            <div class="assessment-item">
                                                <span class="criteria-value" style="font-weight: 500;">
                                                    {{ $sub->nama_sub }}
                                                    <span class="score-badge">{{ $sub->nilai }}</span>
                                                </span>
                                                <a href="{{ route('admin.subkriteria.edit', $sub->id_sub_kriteria) }}"
                                                    class="btn btn-sm text-warning no-print"
                                                    style="padding: 2px 5px; font-size: 0.8rem;">
                                                    ✏️ Edit
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="empty-state-small">Belum ada sub kriteria</div>
                                @endif
                                <div style="margin-top: 10px;" class="no-print">
                                    <a href="{{ route('admin.subkriteria.create', ['kriteria_id' => $kriteria->id_kriteria]) }}"
                                        class="btn btn-sm btn-primary-outline"
                                        style="font-size: 0.8rem; border: 1px dashed var(--secondary-color); color: var(--secondary-color); display: block; text-align: center; padding: 5px;">
                                        + Tambah Sub Kriteria
                                    </a>
                                </div>
                            </td>
                            <td>
                                <a href="{{ route('admin.kriteria.edit', $kriteria->id_kriteria) }}"
                                    class="btn btn-sm text-warning" style="margin-right:5px;">Edit</a>
                                <form action="{{ route('admin.kriteria.destroy', $kriteria->id_kriteria) }}" method="POST"
                                    style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus kriteria ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm text-danger" style="background:none;">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection