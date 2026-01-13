@extends('layouts.admin')

@section('content')
    <div class="card">
        <h3>Input Penilaian Atlet</h3>
        <form action="{{ route('admin.penilaian.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label class="form-label">Nama Atlet / Mahasiswa</label>
                <select name="id_mahasiswa" class="form-control" required>
                    <option value="">-- Pilih Atlet --</option>
                    @foreach($mahasiswas as $mhs)
                        <option value="{{ $mhs->id_mahasiswa }}">{{ $mhs->nama }} - {{ $mhs->nim }}</option>
                    @endforeach
                </select>
            </div>

            <hr style="margin: 20px 0; border: 0; border-top: 1px solid #eee;">

            @foreach($kriterias as $kriteria)
                <div class="form-group">
                    <label class="form-label">{{ $kriteria->nama_kriteria }} (Bobot: {{ $kriteria->bobot }}%)</label>
                    <select name="nilai[{{ $kriteria->id_kriteria }}]" class="form-control" required>
                        <option value="">-- Pilih Nilai --</option>
                        @foreach($kriteria->subkriteria as $sub)
                            <option value="{{ $sub->id_sub_kriteria }}">
                                {{ $sub->nama_sub }} (Nilai: {{ $sub->nilai }})
                            </option>
                        @endforeach
                    </select>
                </div>
            @endforeach

            <button type="submit" class="btn btn-primary" style="margin-top: 20px;">Simpan Penilaian</button>
            <a href="{{ route('admin.penilaian.index') }}" class="btn btn-secondary"
                style="margin-top: 20px; margin-left: 10px;">Kembali</a>
        </form>
    </div>
@endsection