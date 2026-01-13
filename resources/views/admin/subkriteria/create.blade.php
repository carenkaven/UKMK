@extends('layouts.admin')

@section('content')
    <div class="card">
        <h2>Tambah Sub Kriteria</h2>
        <form action="{{ route('admin.subkriteria.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label">Pilih Kriteria</label>
                <select name="id_kriteria" class="form-control" required>
                    <option value="">-- Pilih Kriteria --</option>
                    @foreach($kriterias as $kriteria)
                        <option value="{{ $kriteria->id_kriteria }}">{{ $kriteria->nama_kriteria }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Nama Sub Kriteria</label>
                <input type="text" name="nama_sub" class="form-control" required>
            </div>

            <div class="form-group">
                <label class="form-label">Nilai</label>
                <input type="number" name="nilai" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.subkriteria.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection