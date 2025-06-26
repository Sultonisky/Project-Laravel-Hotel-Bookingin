@extends('backend.v_layouts.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <a href="{{ route('backend.room.index') }}">
                <button type="button" class="btn btn-secondary mb-2"><i class="fas fa-arrow-left"></i> Kembali ke Data Kamar</button>
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
                                    <th>Nama Kamar</th>
                                    <th>Status</th>
                                    <th>Restore</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($trashed as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row->room_name }}</td>
                                        <td>{{ $row->status == 1 ? 'Tersedia' : 'Tidak Tersedia' }}</td>
                                        <td>
                                            @if(auth()->user() && auth()->user()->role == 1)
                                            <form method="POST" action="{{ route('backend.room.restore', $row->id) }}">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm" title="Pulihkan Data"><i class="fas fa-undo"></i> Restore</button>
                                            </form>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Tidak ada data yang dihapus.</td>
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