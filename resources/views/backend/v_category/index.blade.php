@extends('backend.v_layouts.app')
@section('content')
    <!-- contentAwal -->

    <div class="row">

        <div class="col-12">
            <a href="{{ route('backend.category.create') }}">
                <button type="button" class="btn btn-primary"><i class="fas fa-plus"></i>
                    Add Category</button>
            </a>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"> {{ $judul }} </h5>
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Category</th>
                                    <th>Number of Rooms</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($index as $row)
                                    <tr>
                                        <td> {{ $loop->iteration }} </td>
                                        <td> {{ $row->category_name }} </td>
                                        <td> {{ $row->number_of_rooms }} </td>
                                        <td> {{ $row->description }} </td>
                                        <td class="d-flex">
                                            <a href="{{ route('backend.category.edit', $row->id) }}" title="Edit Data">
                                                <button type="button" class="btn btn-cyan btn-sm"><i
                                                        class="far fa-edit"></i> Edit</button>
                                            </a>

                                            <form method="POST" action="{{ route('backend.category.destroy', $row->id) }}"
                                                style="display: inline-block;">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm show_confirm"
                                                    data-konf-delete="{{ $row->category_name }}" title='Delete Data'>
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

    <!-- contentAkhir -->
@endsection
