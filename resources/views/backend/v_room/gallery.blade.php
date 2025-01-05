@extends('backend.v_layouts.app')
@section('content')
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title mb-3">Room Galleries</h4>
            <div class="ml-auto text-right">
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row el-element-overlay">
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="el-card-item">
                        <div class="el-card-avatar el-overlay-1"> <img
                                src="{{ asset('backend/images/img-hotel/standart.jpg') }}"
                                style="width: 100%; height: 200px; object-fit: cover; alt="user" />
                            <div class="el-overlay">
                                <ul class="list-style-none el-info">
                                    <li class="el-item"><a class="btn default btn-outline image-popup-vertical-fit el-link"
                                            href="{{ asset('backend/images/img-hotel/standart.jpg') }}"><i
                                                class="mdi mdi-magnify-plus"></i></a>
                                    </li>
                                    <li class="el-item"><a class="btn default btn-outline el-link"
                                            href="javascript:void(0);"><i class="mdi mdi-link"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="el-card-content">
                            <h4 class="m-b-0">Standart Room</h4> <span class="text-muted"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="el-card-item">
                        <div class="el-card-avatar el-overlay-1"> <img
                                src="{{ asset('backend/images/img-hotel/Deluxe-Room-Double-Bed.jpg') }}"
                                style="width: 100%; height: 200px; object-fit: cover; alt="user" />
                            <div class="el-overlay">
                                <ul class="list-style-none el-info">
                                    <li class="el-item"><a class="btn default btn-outline image-popup-vertical-fit el-link"
                                            href="{{ asset('backend/images/img-hotel/Deluxe-Room-Double-Bed.jpg') }}"><i
                                                class="mdi mdi-magnify-plus"></i></a>
                                    </li>
                                    <li class="el-item"><a class="btn default btn-outline el-link"
                                            href="javascript:void(0);"><i class="mdi mdi-link"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="el-card-content">
                            <h4 class="m-b-0">Deluxe Room</h4> <span class="text-muted"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="el-card-item">
                        <div class="el-card-avatar el-overlay-1"> <img
                                src="{{ asset('backend/images/img-hotel/DeluxeSuite.jpg') }}"
                                style="width: 100%; height: 200px; object-fit: cover; alt="user" />
                            <div class="el-overlay">
                                <ul class="list-style-none el-info">
                                    <li class="el-item"><a class="btn default btn-outline image-popup-vertical-fit el-link"
                                            href="{{ asset('backend/images/img-hotel/DeluxeSuite.jpg') }}"><i
                                                class="mdi mdi-magnify-plus"></i></a>
                                    </li>
                                    <li class="el-item"><a class="btn default btn-outline el-link"
                                            href="javascript:void(0);"><i class="mdi mdi-link"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="el-card-content">
                            <h4 class="m-b-0">Suite Room</h4> <span class="text-muted"></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="el-card-item">
                        <div class="el-card-avatar el-overlay-1"> <img
                                src="{{ asset('backend/images/img-hotel/junior-suite.jpg') }}"
                                style="width: 100%; height: 200px; object-fit: cover; alt="user" />
                            <div class="el-overlay">
                                <ul class="list-style-none el-info">
                                    <li class="el-item"><a class="btn default btn-outline image-popup-vertical-fit el-link"
                                            href="{{ asset('backend/images/img-hotel/junior-suite.jpg') }}"><i
                                                class="mdi mdi-magnify-plus"></i></a>
                                    </li>
                                    <li class="el-item"><a class="btn default btn-outline el-link"
                                            href="javascript:void(0);"><i class="mdi mdi-link"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="el-card-content">
                            <h4 class="m-b-0">Junior Suite Room</h4> <span class="text-muted"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="el-card-item">
                        <div class="el-card-avatar el-overlay-1"> <img
                                src="{{ asset('backend/images/img-hotel/superior-room.jpg') }}"
                                style="width: 100%; height: 200px; object-fit: cover; alt="user" />
                            <div class="el-overlay">
                                <ul class="list-style-none el-info">
                                    <li class="el-item"><a class="btn default btn-outline image-popup-vertical-fit el-link"
                                            href="{{ asset('backend/images/img-hotel/superior-room.jpg') }}"><i
                                                class="mdi mdi-magnify-plus"></i></a>
                                    </li>
                                    <li class="el-item"><a class="btn default btn-outline el-link"
                                            href="javascript:void(0);"><i class="mdi mdi-link"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="el-card-content">
                            <h4 class="m-b-0">Superior Room</h4> <span class="text-muted"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="el-card-item">
                        <div class="el-card-avatar el-overlay-1"> <img
                                src="{{ asset('backend/images/img-hotel/home-living.jpg') }}"
                                style="width: 100%; height: 200px; object-fit: cover; alt="user" />
                            <div class="el-overlay">
                                <ul class="list-style-none el-info">
                                    <li class="el-item"><a
                                            class="btn default btn-outline image-popup-vertical-fit el-link"
                                            href="{{ asset('backend/images/img-hotel/home-living.jpg') }}"><i
                                                class="mdi mdi-magnify-plus"></i></a>
                                    </li>
                                    <li class="el-item"><a class="btn default btn-outline el-link"
                                            href="javascript:void(0);"><i class="mdi mdi-link"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="el-card-content">
                            <h4 class="m-b-0">Home Living Room</h4> <span class="text-muted"></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="el-card-item">
                        <div class="el-card-avatar el-overlay-1"> <img
                                src="{{ asset('backend/images/img-hotel/cabana-room.jpeg') }}"
                                style="width: 100%; height: 200px; object-fit: cover; alt="user" />
                            <div class="el-overlay">
                                <ul class="list-style-none el-info">
                                    <li class="el-item"><a
                                            class="btn default btn-outline image-popup-vertical-fit el-link"
                                            href="{{ asset('backend/images/img-hotel/cabana-room.jpeg') }}"><i
                                                class="mdi mdi-magnify-plus"></i></a>
                                    </li>
                                    <li class="el-item"><a class="btn default btn-outline el-link"
                                            href="javascript:void(0);"><i class="mdi mdi-link"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="el-card-content">
                            <h4 class="m-b-0">Cabana Room</h4> <span class="text-muted"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="el-card-item">
                        <div class="el-card-avatar el-overlay-1"> <img
                                src="{{ asset('backend/images/img-hotel/presidential-suite.jpg') }}"
                                style="width: 100%; height: 200px; object-fit: cover; alt="user" />
                            <div class="el-overlay">
                                <ul class="list-style-none el-info">
                                    <li class="el-item"><a
                                            class="btn default btn-outline image-popup-vertical-fit el-link"
                                            href="{{ asset('backend/images/img-hotel/cabana-room.jpeg') }}"><i
                                                class="mdi mdi-magnify-plus"></i></a>
                                    </li>
                                    <li class="el-item"><a class="btn default btn-outline el-link"
                                            href="javascript:void(0);"><i class="mdi mdi-link"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="el-card-content">
                            <h4 class="m-b-0">Presidential Room</h4> <span class="text-muted"></span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
        </div>
    </div>
@endsection
