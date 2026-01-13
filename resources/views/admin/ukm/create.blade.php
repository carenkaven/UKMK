@extends('layouts.admin')

@section('content')
    <div class="card">
        <h3>Tambah UKM Baru</h3>
        <form action="{{ route('admin.ukm.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Nama UKM <span class="text-danger">*</span></label>
                        <input type="text" name="nama_ukm" class="form-control" required
                            placeholder="Contoh: UKM Bola Voli">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Ketua UKM <span class="text-danger">*</span></label>
                        <input type="text" name="ketua_ukm" class="form-control" required placeholder="Nama Ketua">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Deskripsi Singkat <span class="text-danger">*</span></label>
                <textarea name="deskripsi" class="form-control" rows="3" required
                    placeholder="Deskripsi singkat tentang kegiatan UKM..."></textarea>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Jadwal Latihan</label>
                        <input type="text" name="jadwal" class="form-control" placeholder="Contoh: Senin & Kamis (16:00)">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Prestasi</label>
                        <input type="text" name="prestasi" class="form-control" placeholder="Contoh: Juara 1 Nasional 2024">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Kontak (WhatsApp/Telp)</label>
                        <input type="text" name="kontak" class="form-control" placeholder="Contoh: 0812-3456-7890">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Gambar UKM</label>
                        <input type="file" name="gambar" class="form-control" accept="image/*">
                        <small class="text-muted">Format: JPG, PNG. Maks: 2MB</small>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Simpan UKM</button>
                <a href="{{ route('admin.ukm.index') }}" class="btn btn-secondary" style="margin-left: 10px;">Batal</a>
            </div>
        </form>
    </div>
@endsection