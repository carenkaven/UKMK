@extends('layouts.admin')

@section('content')
    <div class="card">
        <h3>Tambah Fasilitas Baru</h3>
        <form action="{{ route('admin.fasilitas.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label">Nama Fasilitas</label>
                <input type="text" name="nama_fasilitas" class="form-control" required>
            </div>
            <div class="form-group">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.fasilitas.index') }}" class="btn btn-secondary" style="margin-left: 10px;">Batal</a>
        </form>
    </div>
@endsection