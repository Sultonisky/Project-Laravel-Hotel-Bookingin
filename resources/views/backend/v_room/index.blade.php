@extends('backend.v_layouts.app')
@section('content')
    <!-- contentAwal -->

    <div class="row">

        <div class="col-12">
            <a href="{{ route('backend.room.create') }}">
                <button type="button" class="btn btn-primary"><i class="fas fa-plus"></i>
                    Add Room</button>
            </a>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"> {{ $judul }} </h5>
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Room Name</th>
                                    <th>Capacity</th>
                                    <th>Price</th>
                                    {{-- <th>Number of Rooms</th> --}}
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($index as $row)
                                    <tr>
                                        <td> {{ $loop->iteration }}</td>
                                        <td> {{ $row->category->category_name }} </td>
                                        <td>
                                            @if ($row->status == 1)
                                                <span class="badge badge-success"></i>
                                                    Ready</span>
                                            @elseif($row->status == 0)
                                                <span class="badge badge-danger"></i>
                                                    Booked</span>
                                            @endif
                                        </td>

                                        {{-- <td> {{ $row->guest->nama }} </td> --}}
                                        <td> {{ $row->room_name }} </td>
                                        <td> {{ $row->category->capacity }} person </td>
                                        <td> IDR. {{ number_format($row->price, 0, ',', '.') }}
                                            {{-- <td> {{ $row->category->number_of_rooms }} </td> --}}
                                        </td>
                                        {{-- <td> {{ $row->number_of_rooms }}</td> --}}
                                        <td> {{ $row->category->description }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('backend.room.edit', $row->id) }}" title="Edit Data">
                                                    <button type="button" class="btn btn-cyan btn-sm"><i
                                                            class="far fa-edit"></i> Edit</button>
                                                </a>

                                                <a href="{{ route('backend.room.show', $row->id) }}" title="See Data">
                                                    <button type="button" class="btn btn-warning btn-sm"><i
                                                            class="fas fa-plus"></i> Image</button>
                                                </a>


                                                <form method="POST"
                                                    action="{{ route('backend.room.destroy', $row->id) }}">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-sm show_confirm"
                                                        data-konf-delete="{{ $row->name }}" title='Delete Data'>
                                                        <i class="fas fa-trash"></i> Delete</button>
                                                </form>
                                            </div>
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
