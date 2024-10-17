@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2>Tambah Data Guru</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('guru.store') }}" method="POST">
            @csrf
           
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama') }}" required>
                @error('nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="nip" class="form-label">NIP</label>
                <input type="number" class="form-control @error('nip') is-invalid @enderror" id="nip" name="nip" value="{{ old('nip') }}" required>
                @error('nip')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="mapel" class="form-label">Mata Pelajaran</label>
                <input type="text" class="form-control @error('mapel') is-invalid @enderror" id="mapel" name="mapel" value="{{ old('mapel') }}" required>
                @error('mapel')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="gender" class="form-label">Jenis Kelamin</label>
                <select class="form-select @error('gender') is-invalid @enderror" id="gender" name="gender" required>
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="lelaki" {{ old('gender') == 'lelaki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="perempuan" {{ old('gender') == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
                @error('gender')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection
