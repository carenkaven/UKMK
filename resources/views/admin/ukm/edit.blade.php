@extends('layouts.admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white py-3 border-bottom-0">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="mb-0 fw-bold">Edit UKM</h5>
                        <a href="{{ route('admin.ukm.index') }}" class="btn btn-light btn-sm rounded-pill px-3">
                            <i class="bi bi-arrow-left me-1"></i> Kembali
                        </a>
                    </div>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('admin.ukm.update', $ukm->id_ukm) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" name="nama_ukm" class="form-control" id="nama_ukm"
                                        value="{{ $ukm->nama_ukm }}" placeholder="Nama UKM" required>
                                    <label for="nama_ukm">Nama UKM <span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" name="ketua_ukm" class="form-control" id="ketua_ukm"
                                        value="{{ $ukm->ketua_ukm }}" placeholder="Ketua UKM" required>
                                    <label for="ketua_ukm">Ketua UKM <span class="text-danger">*</span></label>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea name="deskripsi" class="form-control" id="deskripsi" style="height: 100px"
                                        placeholder="Deskripsi" required>{{ $ukm->deskripsi }}</textarea>
                                    <label for="deskripsi">Deskripsi Singkat <span class="text-danger">*</span></label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" name="jadwal" class="form-control" id="jadwal"
                                        value="{{ $ukm->jadwal }}" placeholder="Jadwal">
                                    <label for="jadwal">Jadwal Latihan</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" name="prestasi" class="form-control" id="prestasi"
                                        value="{{ $ukm->prestasi }}" placeholder="Prestasi">
                                    <label for="prestasi">Prestasi</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" name="kontak" class="form-control" id="kontak"
                                        value="{{ $ukm->kontak }}" placeholder="Kontak">
                                    <label for="kontak">Kontak</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card bg-light border-dashed">
                                    <div class="card-body p-2">
                                        <div class="d-flex align-items-center gap-3">
                                            @if($ukm->gambar)
                                                <img src="{{ asset($ukm->gambar) }}" class="rounded shadow-sm"
                                                    style="width: 48px; height: 48px; object-fit: cover;">
                                            @endif
                                            <div class="flex-grow-1">
                                                <label class="form-label fs-7 fw-medium text-muted mb-1 ms-1">Gambar
                                                    UKM</label>
                                                <input type="file" name="gambar" class="form-control form-control-sm"
                                                    accept="image/*">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 d-flex justify-content-end mt-4">
                                <button type="submit" class="btn btn-primary px-4 rounded-pill fw-medium">
                                    <i class="bi bi-save me-1"></i> Simpan Perubahan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection