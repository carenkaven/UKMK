@extends('layouts.admin')

@section('content')
    <div class="card">
        <h3>Edit Fasilitas</h3>
        <form action="{{ route('admin.fasilitas.update', $fasilitas->id_fasilitas) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label class="form-label">Nama Fasilitas</label>
                <input type="text" name="nama_fasilitas" value="{{ $fasilitas->nama_fasilitas }}" class="form-control"
                    required>
            </div>
            <div class="form-group">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="3">{{ $fasilitas->deskripsi }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ route('admin.fasilitas.index') }}" class="btn btn-secondary" style="margin-left: 10px;">Batal</a>
        </form>
    </div>
@endsection