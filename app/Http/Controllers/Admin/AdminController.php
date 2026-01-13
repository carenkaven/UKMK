<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $admins = Admin::all();
        return view('admin.admins.index', compact('admins'));
    }

    public function create()
    {
        return view('admin.admins.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_admin' => 'required',
            'username' => 'required|unique:admins,username',
            'password' => 'required|min:6',
        ]);

        Admin::create([
            'nama_admin' => $request->nama_admin,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.admins.index')->with('success', 'Admin berhasil ditambahkan');
    }

    public function edit($id)
    {
        $admin = Admin::findOrFail($id);
        return view('admin.admins.edit', compact('admin'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_admin' => 'required',
            'username' => 'required|unique:admins,username,' . $id . ',id_admin',
        ]);

        $admin = Admin::findOrFail($id);
        $data = [
            'nama_admin' => $request->nama_admin,
            'username' => $request->username,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $admin->update($data);

        return redirect()->route('admin.admins.index')->with('success', 'Admin berhasil diperbarui');
    }

    public function destroy($id)
    {
        Admin::findOrFail($id)->delete();
        return redirect()->route('admin.admins.index')->with('success', 'Admin berhasil dihapus');
    }
}
