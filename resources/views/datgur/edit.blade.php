@extends('layouts.app')

@section('content')
<form action="{{ route('guru.update', $guru->id) }}" method="POST">
    @csrf
    @method('PATCH')
    
    <div class="mb-3">
        <label for="nama" class="form-label">Nama</label>
        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ $guru->nama }}" required>
        @error('nama')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="nip" class="form-label">NIP</label>
        <input type="number" class="form-control @error('nip') is-invalid @enderror" id="nip" name="nip" value="{{ $guru->nip }}" required>
        @error('nip')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="mapel" class="form-label">Mata Pelajaran</label>
        <input type="text" class="form-control @error('mapel') is-invalid @enderror" id="mapel" name="mapel" value="{{ $guru->mapel }}" required>
        @error('mapel')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="gender" class="form-label">Jenis Kelamin</label>
        <select class="form-select @error('gender') is-invalid @enderror" id="gender" name="gender" required>
            <option value="">Pilih Jenis Kelamin</option>
            <option value="lelaki" {{ $guru->gender == 'lelaki' ? 'selected' : '' }}>Laki-laki</option>
            <option value="perempuan" {{ $guru->gender == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
        </select>
        @error('gender')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
</form>

@endsection
