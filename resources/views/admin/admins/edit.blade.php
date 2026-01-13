@extends('layouts.admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white py-3 border-bottom-0">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="mb-0 fw-bold">Edit Admin</h5>
                        <a href="{{ route('admin.admins.index') }}" class="btn btn-light btn-sm rounded-pill px-3">
                            <i class="bi bi-arrow-left me-1"></i> Kembali
                        </a>
                    </div>
                </div>

                <div class="card-body p-4">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('admin.admins.update', $admin->id_admin) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="vstack gap-3">
                            <div class="form-floating">
                                <input type="text" name="nama_admin" value="{{ $admin->nama_admin }}" class="form-control"
                                    id="nama_admin" placeholder="Nama Lengkap" required>
                                <label for="nama_admin">Nama Lengkap</label>
                            </div>

                            <div class="form-floating">
                                <input type="text" name="username" value="{{ $admin->username }}" class="form-control"
                                    id="username" placeholder="Username" required>
                                <label for="username">Username</label>
                            </div>

                            <div class="form-floating">
                                <input type="password" name="password" class="form-control" id="password"
                                    placeholder="Password">
                                <label for="password">Password (Opsional)</label>
                            </div>
                            <div class="form-text mt-0">Kosongkan jika tidak ingin mengubah password.</div>

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