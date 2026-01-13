@extends('layouts.admin')

@section('content')
    <div class="card border-0 shadow-sm rounded-4">
        <div
            class="card-header bg-white py-3 border-bottom-0 d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div>
                <h5 class="mb-1 fw-bold">Manajemen Admin</h5>
                <p class="text-muted small mb-0">Kelola data administrator sistem.</p>
            </div>
            <a href="{{ route('admin.admins.create') }}" class="btn btn-primary btn-sm shadow-sm">
                <i class="bi bi-person-plus me-1"></i> Tambah Admin
            </a>
        </div>

        <div class="card-body p-0">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" style="border-collapse: separate; border-spacing: 0;">
                    <thead class="bg-light">
                        <tr>
                            <th class="border-0 py-3 ps-4" style="width: 50px;">No</th>
                            <th class="border-0 py-3">Nama</th>
                            <th class="border-0 py-3">Username</th>
                            <th class="border-0 py-3 pe-4 text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($admins as $key => $admin)
                            <tr>
                                <td class="ps-4 fw-medium text-muted">{{ $key + 1 }}</td>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center fw-bold"
                                            style="width: 35px; height: 35px;">
                                            {{ substr($admin->nama_admin, 0, 1) }}
                                        </div>
                                        <span class="fw-medium text-dark">{{ $admin->nama_admin }}</span>
                                    </div>
                                </td>
                                <td class="text-muted">{{ $admin->username }}</td>
                                <td class="pe-4 text-end">
                                    <div class="btn-group">
                                        <a href="{{ route('admin.admins.edit', $admin->id_admin) }}"
                                            class="btn btn-sm btn-light text-primary" data-bs-toggle="tooltip" title="Edit">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('admin.admins.destroy', $admin->id_admin) }}" method="POST"
                                            class="d-inline" onsubmit="return confirm('Yakin ingin menghapus admin ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-light text-danger"
                                                data-bs-toggle="tooltip" title="Hapus">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection