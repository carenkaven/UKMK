@extends('layouts.admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white py-3 border-bottom-0">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="mb-0 fw-bold">Input Penilaian Atlet</h5>
                        <a href="{{ route('admin.penilaian.index') }}" class="btn btn-light btn-sm rounded-pill px-3">
                            <i class="bi bi-arrow-left me-1"></i> Kembali
                        </a>
                    </div>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('admin.penilaian.store') }}" method="POST">
                        @csrf

                        <div class="form-floating mb-4">
                            <select name="id_mahasiswa" class="form-select" id="id_mahasiswa" required>
                                <option value="">-- Pilih Atlet --</option>
                                @foreach($mahasiswas as $mhs)
                                    <option value="{{ $mhs->id_mahasiswa }}">{{ $mhs->nama }} ({{ $mhs->nim }})</option>
                                @endforeach
                            </select>
                            <label for="id_mahasiswa">Nama Atlet / Mahasiswa</label>
                        </div>

                        <hr class="border-secondary border-opacity-10 my-4">
                        <h6 class="fw-bold mb-3 text-primary">Form Penilaian (Kriteria)</h6>

                        <div class="row g-3">
                            @foreach($kriterias as $kriteria)
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select name="nilai[{{ $kriteria->id_kriteria }}]" class="form-select"
                                            id="kriteria_{{ $kriteria->id_kriteria }}" required>
                                            <option value="">-- Pilih Nilai --</option>
                                            @foreach($kriteria->subkriteria as $sub)
                                                <option value="{{ $sub->id_sub_kriteria }}">
                                                    {{ $sub->nama_sub }} (Nilai: {{ $sub->nilai }})
                                                </option>
                                            @endforeach
                                        </select>
                                        <label for="kriteria_{{ $kriteria->id_kriteria }}">{{ $kriteria->nama_kriteria }}
                                            ({{ $kriteria->bobot }}%)</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="d-grid mt-5">
                            <button type="submit" class="btn btn-primary rounded-pill fw-medium py-2">
                                <i class="bi bi-save me-1"></i> Simpan Penilaian
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection