@extends('layouts.admin')

@section('content')
    <div class="card">
        <h3>Edit Admin</h3>

        @if ($errors->any())
            <div class="alert alert-danger"
                style="background: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 20px;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.admins.update', $admin->id_admin) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="nama_admin" value="{{ $admin->nama_admin }}" class="form-control" required>
            </div>
            <div class="form-group">
                <label class="form-label">Username</label>
                <input type="text" name="username" value="{{ $admin->username }}" class="form-control" required>
            </div>
            <div class="form-group">
                <label class="form-label">Password (Kosongkan jika tidak ingin mengubah)</label>
                <input type="password" name="password" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ route('admin.admins.index') }}" class="btn btn-secondary" style="margin-left: 10px;">Batal</a>
        </form>
    </div>
@endsection