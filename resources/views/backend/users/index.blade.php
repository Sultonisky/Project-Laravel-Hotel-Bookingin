@extends('backend.layouts.app')
@section('title', 'Lists Users')
@section('contents')

    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="{{ route('backend.users.create') }}" class="btn btn-success">Tambah User</a>
    </div>

    @if (Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif


    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="table-success">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Telepon</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->nama }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone ?? '-' }}</td>
                        <td>{{ $user->address ?? '-' }}</td>
                        <td>
                            <a href="{{ route('backend.users.edit', $user->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <a href="{{ route('backend.users.show', $user->id) }}"
                                class="btn btn-sm btn-secondary">Detail</a>

                            <form action="{{ route('backend.users.destroy', $user->id) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">Belum ada pengguna.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
