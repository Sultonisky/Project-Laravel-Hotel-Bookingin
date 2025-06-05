@extends('backend.layouts.app')

@section('title', 'Edit Profile')

@section('contents')
    <hr />

    <form method="POST" enctype="multipart/form-data" action="{{ route('backend.profile.update') }}">
        @csrf
        <div class="row">
            <div class="col-md-12 border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Edit Profile</h4>
                        <a href="{{ route('backend.profile.show') }}" class="btn btn-sm btn-secondary">Kembali</a>
                    </div>

                    {{-- Foto Profil --}}
                    <div class="text-center mb-3">
                        <img src="{{ $user->foto ? asset('storage/img-users/' . $user->foto) : asset('storage/img-users/profile.png') }}"
                            class="rounded-circle" width="120" height="120" alt="Foto Profil">
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label class="labels">Nama</label>
                            <input type="text" name="nama" class="form-control" value="{{ $user->nama }}">
                        </div>
                        <div class="col-md-6">
                            <label class="labels">Email</label>
                            <input type="text" class="form-control" value="{{ $user->email }}" readonly>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label class="labels">Phone</label>
                            <input type="text" name="phone" class="form-control" value="{{ $user->phone }}">
                        </div>
                        <div class="col-md-6">
                            <label class="labels">Alamat</label>
                            <input type="text" name="address" class="form-control" value="{{ $user->address }}">
                        </div>
                    </div>

                    {{-- Upload Foto --}}
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label class="labels">Foto Baru (jika ingin ganti)</label>
                            <input type="file" name="foto" class="form-control">
                        </div>
                    </div>

                    <div class="mt-5 text-center">
                        <button class="btn btn-primary" type="submit">Simpan Perubahan</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
