@extends('backend.v_layouts.app')
@section('content')
    <!-- contentAwal -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form action="{{ route('backend.user.update', $edit->id) }}" method="post" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <div class="card-body">
                            <h4 class="card-title"> {{ $judul }} </h4>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Foto</label>
                                        {{-- view image --}}
                                        @if ($edit->foto)
                                            <img src="{{ asset('storage/img-user/' . $edit->foto) }}" class="foto-preview"
                                                width="100%">
                                            <p></p>
                                        @else
                                            <img src="{{ asset('img/img_default.jpg') }}" class="foto-preview"
                                                width="100%">
                                            <p></p>
                                        @endif
                                        {{-- file foto --}}
                                        <input type="file" name="foto"
                                            class="form-control @error('foto') is-invalid @enderror "
                                            onchange="previewFoto()">
                                        @error('foto')
                                            <div class="invalid-feedback alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>Role</label>
                                        <select name="role" class="form-control @error('role') is-invalid @enderror">
                                            <option value="" {{ old('role', $edit->role) == '' ? 'selected' : '' }}>
                                                - Select Role -
                                            </option>
                                            <option value="1" {{ old('role', $edit->role) == '1' ? 'selected' : '' }}>
                                                Administrator</option>
                                            <option value="0" {{ old('role', $edit->role) == '0' ? 'selected' : '' }}>
                                                User
                                            </option>
                                        </select>
                                        @error('role')
                                            <span class="invalid-feedback alert-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="status" class="form-control @error('status') is-invalid @enderror">
                                            <option value=""
                                                {{ old('status', $edit->status) == '' ? 'selected' : '' }}> -
                                                Select Status -</option>
                                            <option value="1"
                                                {{ old('status', $edit->status) == '1' ? 'selected' : '' }}>
                                                Active
                                            </option>
                                            <option value="0"
                                                {{ old('status', $edit->status) == '0' ? 'selected' : '' }}>
                                                Non-Active
                                            </option>
                                        </select>
                                        @error('status')
                                            <span class="invalid-feedback alert-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" name="name" value="{{ old('name', $edit->name) }}"
                                            class="form-control @error('name') is-invalid @enderror"
                                            placeholder="Masukkan name">
                                        @error('name')
                                            <span class="invalid-feedback alert-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" name="email" value="{{ old('email', $edit->email) }}"
                                            class="form-control @error('email') is-invalid @enderror"
                                            placeholder="Masukkan Email">
                                        @error('email')
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
                                <a href="{{ route('backend.user.index') }}">
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
