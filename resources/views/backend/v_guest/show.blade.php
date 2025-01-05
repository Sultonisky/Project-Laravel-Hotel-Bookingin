@extends('backend.v_layouts.app')
@section('content')
    {{-- Content Awal --}}
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $judul }}</h5>
                    <table class="table table-bordered">
                        <tr>
                            <th>Foto</th>
                            <td>
                                @if ($guest->foto)
                                    <img src="{{ asset('storage/img-user/' . $guest->foto) }}" alt="{{ $guest->name }}"
                                        class="img-thumbnail">
                                @else
                                    <span class="text-muted">Tidak ada foto</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Name</th>
                            <td>{{ $guest->name }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $guest->email }}</td>
                        </tr>
                        <tr>
                            <th>No HP</th>
                            <td>{{ $guest->no_hp }}</td>
                        </tr>

                    </table>
                    <a href="{{ route('backend.guest.index') }}" class="btn btn-secondary mt-3">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>
            </div>
        </div>
    </div>
    {{-- Content Akhir --}}
@endsection
