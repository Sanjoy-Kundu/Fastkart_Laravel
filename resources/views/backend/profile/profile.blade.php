@extends('layouts.dashboardmaster')

@section('content')
    <div class="page-body">

        <!-- New Product Add Start -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-5">
                    <div class="row">
                        <div class="col-sm-8 m-auto">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-header-2">
                                        <h5>User Information</h5>
                                    </div>
                                    @if (session('success'))
                                        <div class="alert alert-danger">{{ session('success') }}</div>
                                    @endif
                                    <div class="user-information">
                                        <div class="img"
                                            style="height: 250px; width:250px; border:1px solid gray;border-radius:50%;">
                                            @if (auth()->user()->profile_photo)
                                                <img src="{{ asset('uploads/user_photos') }}/{{ auth()->user()->profile_photo }}"
                                                    alt=""
                                                    style="width: 100%; object-fir:cover; height:100%; border-radius:50%;">
                                            @else
                                                <img src="{{ asset('uploads/user_photos/user_default.jpg') }}"
                                                    alt=""
                                                    style="width: 100%; object-fir:cover; height:100%; border-radius:50%;">
                                            @endif


                                        </div>
                                        <hr>
                                        <h2>Name: <span style="color:orange">{{ auth()->user()->name }}</span></h2>
                                        <h3>Email: <span style="color: blue"><b>{{ auth()->user()->email }}</b></span></h3>
                                        <h3>Role: <span style="color:red">{{ auth()->user()->role }}</span></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-7">
                    <div class="row">
                        <div class="col-sm-8 m-auto">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-header-2">
                                        <h5>Update Your Profile</h5>
                                    </div>
                                    @if (session('success'))
                                        <div class="alert alert-danger">{{ session('success') }}</div>
                                    @endif
                                    <form action="{{ url('profile/password') }}" method="POST"
                                        class="theme-form theme-form-2 mega-form">
                                        @csrf
                                        <div class="mb-4 row align-items-center">
                                            <div class="img mx-auto"
                                                style="height: 150px; width:150px; border:1px solid gray;border-radius:50%;">
                                                @if (auth()->user()->profile_photo)
                                                    <img src="{{ asset('uploads/user_photos') }}/{{ auth()->user()->profile_photo }}"
                                                        alt=""
                                                        style="width: 100%; object-fir:cover; height:100%; border-radius:50%;">
                                                @else
                                                    <img src="{{ asset('uploads/user_photos/user_default.jpg') }}"
                                                        alt=""
                                                        style="width: 100%; object-fir:cover; height:100%; border-radius:50%;">
                                                @endif
                                            </div>


                                            <span>Upload Your Photo</span>
                                            <div class="col-sm-9 mt-3">
                                                <input class="form-control" type="file" name="profile_photo">
                                                @error('profile_photo')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Name</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" type="text" name="profile_name"
                                                    value="{{ auth()->user()->name }}">
                                                @error('current_password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0"></label>
                                            <div class="col-sm-9">
                                                <button type="submit" class="btn btn-danger">Add User</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-sm-8 m-auto">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-header-2">
                                        <h5>Update Your Password</h5>
                                    </div>
                                    @if (session('success'))
                                        <div class="alert alert-danger">{{ session('success') }}</div>
                                    @endif
                                    <form action="{{ url('profile/password') }}" method="POST"
                                        class="theme-form theme-form-2 mega-form">
                                        @csrf
                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Current Password</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" type="text" placeholder="Current Password"
                                                    name="current_password">
                                                @error('current_password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">New Password</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" type="text" placeholder="New Password"
                                                    name="current_password">
                                                @error('current_password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Confirmation Password</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" type="text"
                                                    placeholder="Confirmation Password" name="confirmation_password">
                                                @error('confirmation_password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0"></label>
                                            <div class="col-sm-9">
                                                <button type="submit" class="btn btn-danger">Add User</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- New Product Add End -->

        <!-- footer Start -->
        <div class="container-fluid">
            <footer class="footer">
                <div class="row">
                    <div class="col-md-12 footer-copyright text-center">
                        <p class="mb-0">Copyright 2022 © Fastkart theme by pixelstrap</p>
                    </div>
                </div>
            </footer>
        </div>
        <!-- footer En -->
    </div>
    <!-- Container-fluid End -->
    </div>
    <!-- Page Body End -->
    </div>
    <!-- page-wrapper End -->

    <!-- Modal Start -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <h5 class="modal-title" id="staticBackdropLabel">Logging Out</h5>
                    <p>Are you sure you want to log out?</p>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                    <div class="button-box">
                        <button type="button" class="btn btn--no" data-bs-dismiss="modal">No</button>
                        <button type="button" class="btn  btn--yes btn-primary">Yes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal End -->
@endsection
