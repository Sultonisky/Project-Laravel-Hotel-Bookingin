@extends('backend.v_layouts.app')
@section('content')
    {{-- Content Awal --}}
    <div class="row">
        <div class="col-12">
            <a href="{{ route('backend.contact.create') }}">
                <button type="button" class="btn btn-primary btn-sm mb-3">
                    <i class="fas fa-plus"></i> Add Messages
                </button>
            </a>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"></h5>
                    <div class="table-responsive">
                        <table id="guest_table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>E-mail</th>
                                    <th>Messages</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($index as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row->name }}</td>
                                        <td>{{ $row->email }}</td>
                                        <td>{{ $row->messages }}</td>
                                        <td>
                                            <a href="{{ route('backend.contact.edit', $row->id) }}" title="Edit Data">
                                                <button type="button" class="btn btn-cyan btn-sm">
                                                    <i class="far fa-edit"></i> Edit
                                                </button>
                                            </a>
                                            <a href="{{ route('backend.contact.show', $row->id) }}" title="See Details">
                                                <button type="button" class="btn btn-info btn-sm">
                                                    <i class="fas fa-eye"></i> Details
                                                </button>
                                            </a>
                                            <form method="POST" action="" style="display: inline-block;">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm show_confirm"
                                                    data-konf-delete="" title='Delete Data'>
                                                    <i class="fas fa-trash"></i> Delete
                                                </button>

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
    {{-- Content Akhir --}}
@endsection
