@extends('layouts.admin')

@section('content')
    <div class="card">
        <h3>Tambah Kriteria Baru</h3>
        <form action="{{ route('admin.kriteria.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label">Nama Kriteria</label>
                <input type="text" name="nama_kriteria" class="form-control" required>
            </div>
            <div class="form-group">
                <label class="form-label">Bobot</label>
                <input type="number" step="0.01" name="bobot" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.kriteria.index') }}" class="btn btn-secondary" style="margin-left: 10px;">Batal</a>
        </form>
    </div>
@endsection