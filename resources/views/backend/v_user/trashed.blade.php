@extends('backend.v_layouts.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <a href="{{ route('backend.user.index') }}">
                <button type="button" class="btn btn-secondary mb-2"><i class="fas fa-arrow-left"></i> Kembali ke Data User</button>
            </a>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $judul }}</h5>
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Restore</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($trashed as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row->name }}</td>
                                        <td>{{ $row->email }}</td>
                                        <td>{{ $row->role }}</td>
                                        <td>{{ $row->status }}</td>
                                        <td>
                                            @if(auth()->user() && auth()->user()->role == 1)
                                            <form method="POST" action="{{ route('backend.user.restore', $row->id) }}">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm" title="Pulihkan Data"><i class="fas fa-undo"></i> Restore</button>
                                            </form>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Tidak ada data yang dihapus.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection 