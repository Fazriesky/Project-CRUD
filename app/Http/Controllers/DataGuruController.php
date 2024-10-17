<?php

namespace App\Http\Controllers;

use App\Models\data_guru;
use Illuminate\Http\Request;

class DataGuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $guru = data_guru::all();

        return view('datgur.index', compact('guru'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('datgur.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|numeric|unique:data_gurus',
            'mapel' => 'required|string|max:100',
            'gender' => 'required|in:lelaki,perempuan',
        ], [
            'nama.required' => 'Nama guru harus diisi!',
            'nama.string' => 'Nama guru harus berupa string!',
            'nama.max' => 'Nama guru maksimal 255 karakter!',
            'nip.required' => 'NIP guru harus diisi!',
            'nip.numeric' => 'NIP guru harus berupa angka!',
            'nip.unique' => 'NIP guru sudah terdaftar!',
            'mapel.required' => 'Mapel guru harus diisi!',
            'mapel.string' => 'Mapel guru harus berupa string!',
            'mapel.max' => 'Mapel guru maksimal 100 karakter!',
            'gender.required' => 'Gender guru harus diisi!',
            'gender.in' => 'Gender guru harus L (Laki-laki) atau P (Perempuan)!',
        ]);

        data_guru::create($request->all());

        return redirect()->route('guru.index')->with('success', 'Data guru berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(data_guru $data_guru)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $guru = data_guru::find($id);
        return view('datgur.edit', compact('guru'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate input data
        $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|numeric',
            'mapel' => 'required|string|max:100',
            'gender' => 'required|in:lelaki,perempuan',
        ]);

        // Update guru data
        $guru = data_guru::findOrFail($id);

        $guru->nama = $request->input('nama');
        $guru->nip = $request->input('nip');
        $guru->mapel = $request->input('mapel');
        $guru->gender = $request->input('gender');

        $guru->save();

        return redirect()->route('guru.index')->with('success', 'Data guru berhasil diupdate.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Mencari data guru berdasarkan ID
        $data_guru = data_guru::findOrFail($id);
    
        // Menghapus data guru dari database
        $data_guru->delete();
    
        // Mengarahkan kembali ke halaman index dengan pesan sukses
        return redirect()->route('guru.index')->with('success', 'Data guru berhasil dihapus.');
    }
}
