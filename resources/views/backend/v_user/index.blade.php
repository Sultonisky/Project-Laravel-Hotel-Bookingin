@extends('backend.v_layouts.app')
@section('content')
    {{-- content awal --}}

    <div class="row">
        <div class="col-12">
            <a href="{{ route('backend.user.create') }}">
                <button type="button" class="btn btn-primary"><i class="fas fa-plus"></i> Add User</button>
            </a>
            @if(auth()->user() && auth()->user()->role == 1)
            <a href="{{ route('backend.user.trashed') }}">
                <button type="button" class="btn btn-danger"><i class="fas fa-trash"></i> Lihat Data Dihapus</button>
            </a>
            @endif
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"> {{ $judul }} </h5>
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>E-mail</th>
                                    <th>Name</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($index as $row)
                                    <tr>
                                        <td> {{ $loop->iteration }} </td>
                                        <td> {{ $row->email }} </td>
                                        <td> {{ $row->name }} </td>
                                        <td>
                                            @if ($row->role == 1)
                                                <span class="badge badge-success"></i>Administrator</span>
                                            @elseif($row->role == 0)
                                                <span class="badge badge-primary"></i>User</span>
                                            @elseif($row->role == 2)
                                                <span class="badge badge-info"></i>Resepsionis</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($row->status == 1)
                                                <span class="badge badge-success"></i>Active</span>
                                            @elseif($row->status == 0)
                                                <span class="badge badge-secondary"></i>Non-Active</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('backend.user.edit', $row->id) }}" title="Edit Data">
                                                <button type="button" class="btn btn-cyan btn-sm"><i
                                                        class="far fa-edit"></i> Edit</button>
                                            </a>
                                            <a href="{{ route('backend.user.show', $row->id) }}" title="Show Data">
                                                <button type="button" class="btn btn-info btn-sm"><i
                                                        class="far fa-edit"></i> Detail</button>
                                            </a>
                                            <form method="POST" action="{{ route('backend.user.destroy', $row->id) }}"
                                                style="display: 
                                                inline-block;">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm show_confirm"
                                                    data-konf-delete="{{ $row->name }}" title='Delete Data'>
                                                    <i class="fas fa-trash"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- content akhir --}}
@endsection
