@extends('layouts.admin')

@section('content')
    <div class="card">
        <!-- Print Header (Only visible on print) -->

        <div class="header-flex no-print">
            <h3>Data Mahasiswa UKM</h3>
            <div class="dropdown">
                <button class="btn btn-secondary">🖨️ Cetak / Export ▼</button>
                <div class="dropdown-content">
                    <button onclick="window.print()">🖨️ Cetak (Browser)</button>
                    <a href="{{ route('admin.mahasiswa.exportPdf') }}" target="_blank">📄 Export PDF</a>
                </div>
            </div>
        </div>
        <p class="no-print">Daftar semua mahasiswa yang terdaftar dalam sistem.</p>

        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Foto</th>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>UKM</th>
                        <th>Prodi</th>
                        <th>Angkatan</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($mahasiswas as $key => $mhs)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>
                                @if($mhs->foto)
                                    <img src="{{ asset('storage/' . $mhs->foto) }}" alt="Foto"
                                        style="width:50px; height:50px; object-fit:cover; border-radius:50%;">
                                @else
                                    <span style="color:#aaa;">No Photo</span>
                                @endif
                            </td>
                            <td>{{ $mhs->nim }}</td>
                            <td>{{ $mhs->nama }}</td>
                            <td>
                                @foreach($mhs->pendaftaran as $p)
                                    @if($p->status_verifikasi == 'Diterima' && $p->ukm)
                                        <span class="badge bg-primary"
                                            style="font-size: 0.8rem; font-weight: normal;">{{ $p->ukm->nama_ukm }}</span><br>
                                    @endif
                                @endforeach
                            </td>
                            <td>{{ $mhs->prodi }}</td>
                            <td>{{ $mhs->angkatan }}</td>
                            <td>{{ $mhs->email }}</td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection