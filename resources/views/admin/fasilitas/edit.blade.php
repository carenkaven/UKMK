@extends('layouts.admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white py-3 border-bottom-0">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="mb-0 fw-bold">Edit Fasilitas</h5>
                        <a href="{{ route('admin.fasilitas.index') }}" class="btn btn-light btn-sm rounded-pill px-3">
                            <i class="bi bi-arrow-left me-1"></i> Kembali
                        </a>
                    </div>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('admin.fasilitas.update', $fasilitas->id_fasilitas) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="vstack gap-3">
                            <div class="form-floating">
                                <input type="text" name="nama_fasilitas" value="{{ $fasilitas->nama_fasilitas }}"
                                    class="form-control" id="nama_fasilitas" placeholder="Nama Fasilitas" required>
                                <label for="nama_fasilitas">Nama Fasilitas</label>
                            </div>

                            <div class="form-floating">
                                <textarea name="deskripsi" class="form-control" id="deskripsi" style="height: 100px"
                                    placeholder="Deskripsi">{{ $fasilitas->deskripsi }}</textarea>
                                <label for="deskripsi">Deskripsi</label>
                            </div>

                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-primary rounded-pill fw-medium py-2">
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