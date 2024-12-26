@extends('backend.v_layouts.app')
@section('content')
    <!-- contentAwal -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ $judul }}</h4>
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Category</label>
                                    <select name="room_categories_id"
                                        class="form-control @error('room_categories_id') is-invalid @enderror" disabled>
                                        <option value="" selected> - Select Category - </option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ old('room_categories_id', $show->room_categories_id) == $category->id ? 'selected' : '' }}>
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
                                    <input type="text" name="room_name" value="{{ old('room_name', $show->room_name) }}"
                                        class="form-control @error('room_name') isinvalid @enderror"
                                        placeholder="Enter Room Name" disabled>
                                    @error('room_name')
                                        <span class="invalid-feedback alert-danger" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Detail</label>
                                    <textarea name="detail" class="form-control @error('detail') is-invalid @enderror" id="ckeditor" disabled>{{ old('detail', $show->detail) }}</textarea>
                                    @error('detail')
                                        <span class="invalid-feedback alert-danger" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Main Foto</label> <br>
                                    <img src="{{ asset('storage/img-room/' . $show->foto) }}" class="foto-preview"
                                        width="100%">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label>Additional Foto</label>
                                <div id="foto-container">
                                    <div class="row">
                                        @foreach ($show->photos as $photo)
                                            <div class="col-md-8">
                                                <img src="{{ asset('storage/img-room/' . $photo->foto) }}" width="100%">
                                            </div>
                                            <div class="col-md-4">
                                                <form action="{{ route('backend.foto_produk.destroy', $photo->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        @endforeach
                                    </div>
                                    <br>
                                </div>
                                <button type="button" class="btn btn-primary add-foto mt-2">Add Foto</button>
                            </div>

                        </div>
                    </div>

                    <div class="border-top">
                        <div class="card-body">
                            <a href="{{ route('backend.room.index') }}">
                                <button type="button" class="btn btn-secondary">Back</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- contentAkhir -->
@endsection


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const fotoContainer = document.getElementById('foto-container');
        const addFotoButton = document.querySelector('.add-foto');

        addFotoButton.addEventListener('click', function() {
            const fotoRow = document.createElement('div');
            fotoRow.classList.add('form-group', 'row');
            fotoRow.innerHTML = ` 
                <form action="{{ route('backend.foto_produk.store') }}" method="POST" enctype="multipart/form-data"> 
                    @csrf 
                    <div class="col-md-12"> 
                        <input type="hidden" name="rooms_id" value="{{ $show->id }}"> 
                        <input type="file" name="foto_rooms[]" class="form-control @error('foto_rooms') is-invalid @enderror"> 
                        <button type="submit" class="btn btn-success">Simpan</button> 
                    </div> 
                </form> 
            `;
            fotoContainer.appendChild(fotoRow);
        });
    });
</script>
