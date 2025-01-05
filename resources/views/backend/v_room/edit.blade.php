@extends('backend.v_layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form action="{{ route('backend.room.update', $edit->id) }}" method="post" enctype="multipart/form-data">
                        @method('put')
                        @csrf

                        <div class="card-body">
                            <h4 class="card-title"> {{ $judul }} </h4>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Foto</label>
                                        {{-- Preview gambar --}}
                                        @if ($edit->foto)
                                            <img src="{{ asset('storage/img-room/' . $edit->foto) }}"
                                                class="foto-preview img-fluid mb-2" alt="Room Image">
                                        @else
                                            <img src="{{ asset('storage/img-room/img-default.jpg') }}"
                                                class="foto-preview img-fluid mb-2" alt="Default Image">
                                        @endif

                                        {{-- Input file foto --}}
                                        <input type="file" name="foto"
                                            class="form-control @error('foto') is-invalid @enderror"
                                            onchange="previewFoto(event)">
                                        @error('foto')
                                            <div class="invalid-feedback alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="status" class="form-control @error('status') is-invalid @enderror">
                                            <option value=""
                                                {{ old('status', $edit->status) == '' ? 'selected' : '' }}> - Select Status
                                                -
                                            </option>
                                            <option value="1"
                                                {{ old('status', $edit->status) == '1' ? 'selected' : '' }}>Ready</option>
                                            <option value="0"
                                                {{ old('status', $edit->status) == '0' ? 'selected' : '' }}>Booked</option>
                                        </select>
                                        @error('status')
                                            <span class="invalid-feedback alert-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Category</label>
                                        <select name="room_categories_id"
                                            class="form-control @error('room_categories_id') is-invalid @enderror">
                                            <option value="" selected> - Pilih Kategori - </option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ old('room_categories_id', $edit->room_categories_id) == $category->id ? 'selected' : '' }}>
                                                    {{ $category->category_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('room_categories_id')
                                            <span class="invalid-feedback alert-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Room Name</label>
                                        <input type="text" name="room_name"
                                            value="{{ old('room_name', $edit->room_name) }}"
                                            class="form-control @error('room_name') is-invalid @enderror"
                                            placeholder="Enter Room Name">
                                        @error('room_name')
                                            <span class="invalid-feedback alert-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Descriotion</label>
                                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="ckeditor">{{ old('description', $edit->category->description) }}</textarea>
                                        @error('description')
                                            <span class="invalid-feedback alert-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Price</label>
                                        <input type="text" onkeypress="return hanyaAngka(event)" name="price"
                                            value="{{ old('price', $edit->price) }}"
                                            class="form-control @error('price') is-invalid @enderror"
                                            placeholder="Enter the Price of Room">
                                        @error('price')
                                            <span class="invalid-feedback alert-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Number of Rooms</label>
                                        <input type="text" name="number_of_rooms"
                                            value="{{ old('number_of_rooms', $edit->category->number_of_rooms) }}"
                                            class="form-control @error('number_of_rooms') is-invalid @enderror"
                                            placeholder="Enter the Number of Rooms">
                                        @error('number_of_rooms')
                                            <span class="invalid-feedback alert-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="border-top">
                            <div class="card-body">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{ route('backend.room.index') }}" class="btn btn-secondary">Back</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- <script>
        // Preview foto saat dipilih
        function previewFoto(event) {
            const preview = document.querySelector('.foto-preview');
            preview.src = URL.createObjectURL(event.target.files[0]);
        }

        // Fungsi hanya angka untuk input
        function hanyaAngka(evt) {
            var charCode = evt.which ? evt.which : event.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) return false;
            return true;
        }
    </script> --}}
@endsection
