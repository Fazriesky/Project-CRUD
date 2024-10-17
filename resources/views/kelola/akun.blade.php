@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Kelola Akun</h2>
            <a href="{{ route('akun.create') }}" class="btn btn-primary">Tambah Akun</a>
        </div>

        {{-- @if($guru->isEmpty())
            <div class="alert alert-warning">
                Tidak ada data guru yang tersedia.
            </div>
        @else --}}
            <table class="table table-bordered table-striped">
                <thead class="table-primary">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            {{-- <td>{{ $item->password }}</td> --}}
                            <td>{{ $item->role }}</td>
                            <td>
                                <a href="{{ route('akun.edit', $item->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                <form id="delete-form-{{ $item->id }}" action="{{ route('akun.destroy', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $item->id }})">Hapus</button>
                                </form>                                
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        
    </div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(id) {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                // Kirim form secara manual jika konfirmasi "Yes, delete it!"
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>
@endsection