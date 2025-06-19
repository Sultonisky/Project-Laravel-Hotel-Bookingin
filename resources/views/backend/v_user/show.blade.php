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
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Foto</label>
                                    @if ($show->foto)
                                        <img src="{{ asset('storage/img-user/' . $show->foto) }}" class="foto-preview"
                                            width="100%">
                                    @else
                                        <img src="{{ asset('img/img_default.jpg') }}" class="foto-preview" width="100%">
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>User ID</label>
                                    <input type="text" class="form-control" value="{{ $show->id }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" value="{{ $show->name }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" class="form-control" value="{{ $show->email }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Role</label>
                                    <input type="text" class="form-control"
                                        value="{{ $show->role == 0 ? 'User' : ($show->role == 1 ? 'Admin' : 'Resepsionis') }}"
                                        readonly>
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <input type="text" class="form-control"
                                        value="{{ $show->status == 0 ? 'Non-Active' : 'Active' }}" readonly>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="border-top">
                        <div class="card-body">
                            <a href="{{ route('backend.user.index') }}">
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
