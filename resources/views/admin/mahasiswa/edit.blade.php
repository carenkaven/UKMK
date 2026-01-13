@extends('layouts.admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white py-3 border-bottom-0">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="mb-0 fw-bold">Edit Mahasiswa</h5>
                        <a href="{{ route('admin.mahasiswa.index') }}" class="btn btn-light btn-sm rounded-pill px-3">
                            <i class="bi bi-arrow-left me-1"></i> Kembali
                        </a>
                    </div>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('admin.mahasiswa.update', $mahasiswa->id_mahasiswa) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" name="nim" class="form-control" id="nim"
                                        value="{{ $mahasiswa->nim }}" placeholder="NIM" required>
                                    <label for="nim">NIM</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" name="nama" class="form-control" id="nama"
                                        value="{{ $mahasiswa->nama }}" placeholder="Nama" required>
                                    <label for="nama">Nama</label>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="email" name="email" class="form-control" id="email"
                                        value="{{ $mahasiswa->email }}" placeholder="Email" required>
                                    <label for="email">Email</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" name="prodi" class="form-control" id="prodi"
                                        value="{{ $mahasiswa->prodi }}" placeholder="Prodi" required>
                                    <label for="prodi">Prodi</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" name="angkatan" class="form-control" id="angkatan"
                                        value="{{ $mahasiswa->angkatan }}" placeholder="Angkatan" required>
                                    <label for="angkatan">Angkatan</label>
                                </div>
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-medium text-muted small">Foto</label>
                                <div class="card bg-light border-dashed">
                                    <div class="card-body text-center p-3">
                                        @if($mahasiswa->foto)
                                            <div class="mb-3">
                                                <img src="{{ asset('storage/' . $mahasiswa->foto) }}" alt="Foto"
                                                    class="rounded-circle shadow-sm"
                                                    style="width: 100px; height: 100px; object-fit: cover;">
                                            </div>
                                        @endif
                                        <input type="file" name="foto" class="form-control form-control-sm w-75 mx-auto">
                                        <div class="form-text mt-2 text-muted">Biarkan kosong jika tidak ingin mengubah
                                            foto.</div>
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