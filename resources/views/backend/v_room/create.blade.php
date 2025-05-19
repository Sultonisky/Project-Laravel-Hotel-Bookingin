@extends('backend.v_layouts.app')
@section('content')
    <!-- contentAwal -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form class="form-horizontal" action="{{ route('backend.room.store') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="card-body">
                            <h4 class="card-title"> {{ $judul }} </h4>
                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Foto</label>
                                        <img class="foto-preview">
                                        <input type="file" name="foto"
                                            class="form-control @error('foto') is-invalid @enderror"
                                            onchange="previewFoto()">
                                        @error('foto')
                                            <div class="invalid-feedback alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>

                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>Category</label>
                                        <select class="form-control @error('room_categories') isinvalid @enderror"
                                            name="room_categories_id">
                                            <option value="" selected>--Select Category-
                                            </option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"> {{ $category->category_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('room_categories_id')
                                            <span class="invalid-feedback alert-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    {{-- <div class="form-group">
                                        <label>Guest</label>
                                        <select class="form-control @error('guests') isinvalid @enderror" name="guests_id">
                                            <option value="" selected>--Select Guest-
                                            </option>
                                            @foreach ($guests as $guest)
                                                <option value="{{ $guest->id }}"> {{ $guest->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('guests_id')
                                            <span class="invalid-feedback alert-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div> --}}
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="status" class="form-control @error('status') is-invalid @enderror">
                                            <option value="" disabled selected>-- Select Status --</option>
                                            <option value="1">Ready</option>
                                            <option value="0">Booked</option>
                                        </select>
                                        @error('status')
                                            <span class="invalid-feedback alert-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Features</label>
                                        <div class="row">
                                            @foreach ($features as $feature)
                                                <div class="col-md-4">
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" name="features[]"
                                                            value="{{ $feature->id }}" id="feature_{{ $feature->id }}">
                                                        <label class="form-check-label"
                                                            for="feature_{{ $feature->id }}">{{ $feature->name }}</label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>



                                    <div class="form-group">
                                        <label>Room Name</label>
                                        <input type="text" name="room_name" value="{{ old('room_name') }}"
                                            class="form-control @error('room_name') is-invalid @enderror"
                                            placeholder="Enter Name of Room">
                                        @error('room_name')
                                            <span class="invalid-feedback alert-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    {{-- <div class="form-group">
                                        <label>Description Room</label><br>
                                        <textarea name="detail" class="form-control @error('detail') is-invalid @enderror"
                                            placeholder="Enter details about the room...">{{ old('detail') }}</textarea>
                                        @error('detail')
                                            <span class="invalid-feedback alert-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div> --}}


                                    <div class="form-group">
                                        <label>Price</label>
                                        <input type="text" onkeypress="return hanyaAngka(event)" name="price"
                                            value="{{ old('price') }}"
                                            class="form-control @error('price') is-invalid @enderror"
                                            placeholder="Enter Price of Room">
                                        @error('price')
                                            <span class="invalid-feedback alert-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    {{-- <div class="form-group">
                                        <label>Number of Rooms</label>
                                        <input type="text" onkeypress="return hanyaAngka(event)" name="number_of_rooms"
                                            value="{{ old('number_of_rooms') }}"
                                            class="form-control @error('number_of_rooms') is-invalid @enderror"
                                            placeholder="Enter Number of Rooms">
                                        @error('number_of_rooms')
                                            <span class="invalid-feedback alert-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                        <div class="border-top">
                            <div class="card-body">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <a href="{{ route('backend.room.index') }}">
                                    <button type="button" class="btn btn-secondary">back</button>
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
