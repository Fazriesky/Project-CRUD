@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2>Tambah Akun</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Tambahkan id untuk form -->
        <form id="accountForm" action="{{ route('akun.store') }}" method="POST">
            @csrf

            <!-- Nama -->
            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="password isi ini dengan 8 karakter" class="form-label">Password: (minimal 8 karakter)</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Role -->
            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required>
                    <option value="">Pilih Role</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>admin</option>
                    <option value="siswa" {{ old('role') == 'siswa' ? 'selected' : '' }}>siswa</option>
                </select>
                @error('role')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Hapus type="submit" dari tombol -->
            <button type="button" class="btn btn-primary" onclick="confirmSave()">Simpan</button>
        </form>
    </div>

    <!-- Tambahkan script SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmSave() {
            Swal.fire({
                title: "Apakah Anda yakin ingin menyimpan perubahan?",
                icon: "warning",
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: "Simpan",
                denyButtonText: `Jangan Simpan`,
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jangan langsung submit, tunggu 1 detik dulu
                    setTimeout(() => {
                        document.getElementById('accountForm').submit();
                    }, 1000);
                } else if (result.isDenied) {
                    Swal.fire("perubahan tidak di simpan", "", "info");
                }
            });
        }
    </script>
@endsection
