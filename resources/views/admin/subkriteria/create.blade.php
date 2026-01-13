@extends('layouts.admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white py-3 border-bottom-0">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="mb-0 fw-bold">Tambah Sub Kriteria</h5>
                        <a href="{{ route('admin.subkriteria.index') }}" class="btn btn-light btn-sm rounded-pill px-3">
                            <i class="bi bi-arrow-left me-1"></i> Kembali
                        </a>
                    </div>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('admin.subkriteria.store') }}" method="POST">
                        @csrf
                        <div class="vstack gap-3">
                            <div class="form-floating">
                                <select name="id_kriteria" class="form-select" id="id_kriteria" required>
                                    <option value="">-- Pilih Kriteria --</option>
                                    @foreach($kriterias as $kriteria)
                                        <option value="{{ $kriteria->id_kriteria }}">
                                            {{ $kriteria->nama_kriteria }} ({{ $kriteria->bobot }}%)
                                        </option>
                                    @endforeach
                                </select>
                                <label for="id_kriteria">Pilih Kriteria</label>
                            </div>

                            <div class="form-floating">
                                <input type="text" name="nama_sub" class="form-control" id="nama_sub"
                                    placeholder="Nama Sub Kriteria" required>
                                <label for="nama_sub">Nama Sub Kriteria</label>
                            </div>

                            <div class="form-floating">
                                <input type="number" name="nilai" class="form-control" id="nilai" placeholder="Nilai"
                                    required>
                                <label for="nilai">Nilai</label>
                            </div>

                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-primary rounded-pill fw-medium py-2">
                                    <i class="bi bi-save me-1"></i> Simpan Sub Kriteria
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection