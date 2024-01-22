@extends('backend.index')
@section('content')
<div class="pagetitle">
    <h1>Manajemen Asset</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Detail User</li>
        </ol>
    </nav>
</div>

<section class="section profile">
    <div class="row">
        <div class="col-xl-4">
            <div class="card">


                @if($errors->any())
                    <ul class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            <li class="text-danger">{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                @empty($rs->foto)
                    <br /><img src="{{ asset('backend/assets/img/nophoto.png') }}"
                        class="rounded-circle" />
                @else
                    <img src="{{ asset('backend/assets/img') }}/{{ $rs->foto }}"
                        class="rounded-circle" />
                    @endempty
                    <h2>{{ $rs->name }}</h2>
                    <h3>{{ $rs->role }}</h3>
                </div>
            </div>

        </div>

        <div class="col-xl-8">

            <div class="card">
                <div class="card-body pt-3">
                    @if(session('message'))
                        <h5 class="alert alert-success mb-2">{{ session('message') }}</h5>
                    @endif
                    <!-- Bordered Tabs -->
                    <ul class="nav nav-tabs nav-tabs-bordered">
                        <li class="nav-item">
                            <button class="nav-link active" data-bs-toggle="tab"
                                data-bs-target="#profile-overview">Overview</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit
                                Profile</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab"
                                data-bs-target="#profile-change-password">Change Password</button>
                        </li>
                    </ul>
                    <div class="tab-content pt-2">

                        <div class="tab-pane fade show active profile-overview" id="profile-overview">

                            <h5 class="card-title">Profile Details</h5>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label ">Full Name</div>
                                <div class="col-lg-9 col-md-8">{{ $rs->name }}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Email</div>
                                <div class="col-lg-9 col-md-8">{{ $rs->email }}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Role</div>
                                <div class="col-lg-9 col-md-8">{{ $rs->role }}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Is Active</div>
                                <div class="col-lg-9 col-md-8">{{ $rs->isactive }}</div>
                            </div>


                        </div>

                        <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                            <!-- Profile Edit Form -->
                            <form method="POST" action="{{ url('edit-profile', $rs->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row mb-3">
                                    <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile
                                        Image</label>
                                    <div class="col-md-8 col-lg-9">
                                    @empty($rs->foto)
                                        <img src="{{ asset('admin/image/nophoto.png') }}"
                                            class="rounded-circle" />
                                    @else
                                        <img src="{{ asset('admin/image') }}/{{ $rs->foto }}"
                                            class="rounded-circle" />
                                        @endempty
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-md-4 col-lg-3 col-form-label">Full
                                        Name</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="name" type="text" class="form-control" id="name"
                                            value="{{ $rs->name }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-md-4 col-lg-3 col-form-label">Email</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="email" type="email" class="form-control" id="email"
                                            value="{{ $rs->email }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-md-4 col-lg-3 col-form-label">Foto</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input type="file" class="form-control @error('foto') is-invalid @enderror"
                                            name="foto" />
                                        @error('foto')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </form><!-- End Profile Edit Form -->

                        </div>

                        <div class="tab-pane fade pt-3" id="profile-change-password">
                            <!-- Change Password Form -->
                            <form method="POST" action="{{ url('change-password') }}">
                                @csrf

                                <div class="row mb-3">
                                    <label for="currentPassword" class="col-md-6 col-lg-5 col-form-label">Current
                                        Password</label>
                                    <div class="col-md-6 col-lg-7">
                                        <input name="current_password" type="password" class="form-control" />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="newPassword" class="col-md-6 col-lg-5 col-form-label">New
                                        Password</label>
                                    <div class="col-md-6 col-lg-7">
                                        <input name="password" type="password" class="form-control" />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="renewPassword" class="col-md-6 col-lg-5 col-form-label">Re-enter
                                        New Password</label>
                                    <div class="col-md-6 col-lg-7">
                                        <input name="password_confirmation" type="password" class="form-control" />
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Change Password</button>
                                </div>
                            </form><!-- End Change Password Form -->

                        </div>

                    </div><!-- End Bordered Tabs -->

                </div>
            </div>

        </div>
    </div>
</section>

@endsection
