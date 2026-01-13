@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="header-flex">
            <h3>Edit Mahasiswa</h3>
            <a href="{{ route('admin.mahasiswa.index') }}" class="btn btn-secondary">Kembali</a>
        </div>

        <form action="{{ route('admin.mahasiswa.update', $mahasiswa->id_mahasiswa) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>NIM</label>
                <input type="text" name="nim" class="form-control" value="{{ $mahasiswa->nim }}" required>
            </div>

            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="nama" class="form-control" value="{{ $mahasiswa->nama }}" required>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ $mahasiswa->email }}" required>
            </div>

            <div class="form-group">
                <label>Prodi</label>
                <input type="text" name="prodi" class="form-control" value="{{ $mahasiswa->prodi }}" required>
            </div>

            <div class="form-group">
                <label>Angkatan</label>
                <input type="text" name="angkatan" class="form-control" value="{{ $mahasiswa->angkatan }}" required>
            </div>

            <div class="form-group">
                <label>Foto (Biarkan kosong jika tidak ingin mengubah)</label>
                <input type="file" name="foto" class="form-control">
                @if($mahasiswa->foto)
                    <small>Foto saat ini:</small><br>
                    <img src="{{ asset('storage/' . $mahasiswa->foto) }}" alt="Foto" style="width: 100px; margin-top: 5px;">
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>
@endsection