@extends('layouts.admin')

@section('content')
    <div class="card">
        <h3>Edit UKM</h3>
        <form action="{{ route('admin.ukm.update', $ukm->id_ukm) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Nama UKM <span class="text-danger">*</span></label>
                        <input type="text" name="nama_ukm" value="{{ $ukm->nama_ukm }}" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Ketua UKM <span class="text-danger">*</span></label>
                        <input type="text" name="ketua_ukm" value="{{ $ukm->ketua_ukm }}" class="form-control" required>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Deskripsi Singkat <span class="text-danger">*</span></label>
                <textarea name="deskripsi" class="form-control" rows="3" required>{{ $ukm->deskripsi }}</textarea>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Jadwal Latihan</label>
                        <input type="text" name="jadwal" value="{{ $ukm->jadwal }}" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Prestasi</label>
                        <input type="text" name="prestasi" value="{{ $ukm->prestasi }}" class="form-control">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Kontak</label>
                        <input type="text" name="kontak" value="{{ $ukm->kontak }}" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Gambar UKM</label>
                        @if($ukm->gambar)
                            <div class="mb-2">
                                <img src="{{ asset($ukm->gambar) }}" alt="Current Image"
                                    style="height: 50px; border-radius: 4px;">
                            </div>
                        @endif
                        <input type="file" name="gambar" class="form-control" accept="image/*">
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('admin.ukm.index') }}" class="btn btn-secondary" style="margin-left: 10px;">Batal</a>
            </div>
        </form>
    </div>
@endsection