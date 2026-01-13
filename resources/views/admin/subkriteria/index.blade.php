@extends('layouts.admin')

@section('content')
    <div class="card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h2>Data Sub Kriteria</h2>
            <a href="{{ route('admin.subkriteria.create') }}" class="btn btn-primary">Tambah Sub Kriteria</a>
        </div>

        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kriteria</th>
                        <th>Nama Sub Kriteria</th>
                        <th>Nilai</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($subkriterias as $sub)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $sub->kriteria->nama_kriteria ?? '-' }}</td>
                            <td>{{ $sub->nama_sub }}</td>
                            <td>{{ $sub->nilai }}</td>
                            <td>
                                <a href="{{ route('admin.subkriteria.edit', $sub->id_sub_kriteria) }}"
                                    class="btn btn-secondary">Edit</a>
                                <form action="{{ route('admin.subkriteria.destroy', $sub->id_sub_kriteria) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection