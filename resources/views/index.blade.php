@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg border-0 rounded">
                    <div class="card-header bg-primary text-white text-center">
                        <h3>Data Guru</h3>
                    </div>

                    <div class="card-body p-4">
                        {{-- <div class="text-center mb-4">
                            <img src="https://via.placeholder.com/150" alt="Data Guru" class="rounded-circle shadow">
                        </div> --}}
                        <p class="text-center fs-5">
                            Selamat datang di website <strong>Data Guru</strong>. Website ini dibuat untuk memudahkan pengelolaan data guru di sekolah. Anda dapat mengelola data guru, menambahkan data guru baru, mengedit data guru yang sudah ada, dan menghapus data guru yang tidak diperlukan lagi.
                        </p>

                        <div class="text-center mt-4">
                            <a href="kelola" class="btn btn-primary btn-lg shadow">Kelola Data Guru</a>
                            <a href="#" class="btn btn-outline-primary btn-lg shadow">Tambah Guru Baru</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
