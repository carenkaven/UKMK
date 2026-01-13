@extends('layouts.admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white py-3 border-bottom-0">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="mb-0 fw-bold">Edit Kriteria</h5>
                        <a href="{{ route('admin.kriteria.index') }}" class="btn btn-light btn-sm rounded-pill px-3">
                            <i class="bi bi-arrow-left me-1"></i> Kembali
                        </a>
                    </div>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('admin.kriteria.update', $kriteria->id_kriteria) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="vstack gap-3">
                            <div class="form-floating">
                                <input type="text" name="nama_kriteria" value="{{ $kriteria->nama_kriteria }}"
                                    class="form-control" id="nama_kriteria" placeholder="Nama Kriteria" required>
                                <label for="nama_kriteria">Nama Kriteria</label>
                            </div>

                            <div class="form-floating">
                                <input type="number" step="0.01" name="bobot" value="{{ $kriteria->bobot }}"
                                    class="form-control" id="bobot" placeholder="Bobot" required>
                                <label for="bobot">Bobot (%)</label>
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