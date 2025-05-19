@extends('backend.v_layouts.app')
@section('content')
    <!-- contentAwal -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form action="{{ route('backend.category.update', $edit->id) }}" method="post">
                        @method('put')
                        @csrf
                        <div class="card-body">
                            <h4 class="card-title"> {{ $judul }} </h4>
                            <div class="form-group">
                                <label>Category Name</label>
                                <input type="text" name="category_name"
                                    value="{{ old('category_name', $edit->category_name) }}"
                                    class="form-control @error('category_name') is-invalid @enderror"
                                    placeholder="Masukkan Nama Kategori">
                                @error('category_name')
                                    <span class="invalid-feedback alert-danger" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Capacity</label>
                                <input type="text" name="capacity" value="{{ old('capacity', $edit->capacity) }}"
                                    class="form-control @error('capacity') is-invalid @enderror"
                                    placeholder="Enter Capacity">
                                @error('capacity')
                                    <span class="invalid-feedback alert-danger" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Bed Size</label>
                                <input type="text" name="bed_size" value="{{ old('bed_size', $edit->bed_size) }}"
                                    class="form-control @error('bed_size') is-invalid @enderror"
                                    placeholder="Enter Bed Size">
                                @error('bed_size')
                                    <span class="invalid-feedback alert-danger" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Number of Rooms</label>
                                <input type="text" name="number_of_rooms"
                                    value="{{ old('number_of_rooms', $edit->number_of_rooms) }}"
                                    class="form-control @error('number_of_rooms') is-invalid @enderror"
                                    placeholder="Input Number of Rooms">
                                @error('number_of_rooms')
                                    <span class="invalid-feedback alert-danger" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Description</label>
                                <input type="text" name="description"
                                    value="{{ old('description', $edit->description) }}"
                                    class="form-control @error('description') is-invalid @enderror"
                                    placeholder="Input Description">
                                @error('description')
                                    <span class="invalid-feedback alert-danger" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                        </div>
                        <div class="border-top">
                            <div class="card-body">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{ route('backend.category.index') }}">
                                    <button type="button" class="btn btn-secondary">Back</button>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- contentAkhir -->
@endsection
