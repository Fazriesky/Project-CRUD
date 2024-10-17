<?php

namespace App\Http\Controllers;

use App\Models\User; // Menggunakan model User (untuk akun)
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource (Menampilkan daftar akun).
     */
    public function index()
    {
        $users = User::all(); // Mendapatkan semua data akun
        return view('kelola.akun', compact('users'));
    }

    /**
     * Show the form for creating a new resource (Menampilkan form pembuatan akun).
     */
    public function create()
    {
        return view('kelola.create_akun');
    }

    /**
     * Store a newly created resource in storage (Menyimpan akun baru).
     */
    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|string|in:admin,siswa', // Validasi role hanya boleh "admin" atau "siswa"
        ], [
            'name.required' => 'Nama pengguna harus diisi!',
            'name.string' => 'Nama pengguna harus berupa string!',
            'name.max' => 'Nama pengguna maksimal 255 karakter!',
            'email.required' => 'Email harus diisi!',
            'email.email' => 'Format email tidak valid!',
            'email.max' => 'Email maksimal 255 karakter!',
            'email.unique' => 'Email sudah terdaftar!',
            'password.required' => 'Kata sandi harus diisi!',
            'password.min' => 'Kata sandi minimal 8 karakter!',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok!',
            'role.required' => 'Role harus dipilih!',
            'role.in' => 'Role harus "admin" atau "siswa"!',
        ]);

        // Menyimpan akun baru ke dalam database
        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')), // Enkripsi password
            'role' => $request->input('role'), // Menyimpan role yang dipilih (admin atau siswa)
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('akun.index')->with('success', 'Akun berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource (Menampilkan form edit akun).
     */
    public function edit($id)
    {
        $user = User::find($id); // Mencari data akun berdasarkan ID
        return view('kelola.edit_akun', compact('user'));
    }

    /**
     * Update the specified resource in storage (Mengupdate akun).
     */
    public function update(Request $request, $id)
    {
        // Mendapatkan user yang akan diupdate
        $user = User::findOrFail($id);

        // Validasi input dari form
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required','string','email','max:255',
            'password' => 'nullable|string', // Password boleh kosong, minimal 8 karakter
            'role' => 'required|string|in:admin,siswa', // Validasi role hanya "admin" atau "siswa"
        ], [
            'name.required' => 'Nama pengguna harus diisi!',
            'name.string' => 'Nama pengguna harus berupa string!',
            'name.max' => 'Nama pengguna maksimal 255 karakter!',
            'email.required' => 'Email harus diisi!',
            'email.email' => 'Format email tidak valid!',
            'email.max' => 'Email maksimal 255 karakter!',
            'email.unique' => 'Email sudah terdaftar!',
            'password.min' => 'Kata sandi minimal 8 karakter!',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok!',
            'role.required' => 'Role harus dipilih!',
            'role.in' => 'Role harus "admin" atau "siswa"!',
        ]);

        // Update nama dan email
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        // Update role
        $user->role = $request->input('role');

        // Jika password diisi, maka update password
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        // Simpan perubahan
        $user->save();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('akun.index')->with('success', 'Akun berhasil diupdate.');
    }


    /**
     * Remove the specified resource from storage (Menghapus akun).
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id); // Mencari akun berdasarkan ID
        $user->delete(); // Menghapus akun

        return redirect()->route('akun.index')->with('success', 'Akun berhasil dihapus.');
    }
}
