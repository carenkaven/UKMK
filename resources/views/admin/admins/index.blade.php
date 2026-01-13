@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="header-flex">
            <h3>Manajemen Admin</h3>
            <a href="{{ route('admin.admins.create') }}" class="btn btn-primary">+ Tambah Admin</a>
        </div>

        @if(session('success'))
            <div
                style="background:#d4edda; color:#155724; padding:15px; border-radius:8px; margin-bottom:20px; border: 1px solid #c3e6cb;">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($admins as $key => $admin)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $admin->nama_admin }}</td>
                            <td>{{ $admin->username }}</td>
                            <td>
                                <a href="{{ route('admin.admins.edit', $admin->id_admin) }}" class="btn btn-sm text-warning"
                                    style="margin-right:5px;">Edit</a>
                                <form action="{{ route('admin.admins.destroy', $admin->id_admin) }}" method="POST"
                                    style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus admin ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm text-danger" style="background:none;">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection