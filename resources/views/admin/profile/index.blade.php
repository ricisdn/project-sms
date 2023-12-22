@extends('layouts.master-admin')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <!-- Add content header if needed -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <section class="content">
            <div class="container-fluid">
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="row">
                    <div class="col-xl-4">
                        <!-- Profile picture card-->
                        <div class="card mb-4 mb-xl-0">
                            <div class="card-header">Gambar Profil</div>
                            <div class="card-body text-center">
                                <!-- Profile picture image-->
                                <div class="img-container mx-auto"
                                    style="width: 170px; height: 170px; border-radius: 50%; overflow: hidden; background-color: black;">
                                    @if ($user->foto)
                                        <img src="{{ asset('uploads/profile/' . $user->foto) }}" alt=""
                                            style="width: 170px; height: 170px; background-size: cover; background-position: center">
                                    @endif
                                </div>

                                <div class="small font-italic text-muted mb-4 mt-2">JPEG or PNG no larger than 5 MB</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-8">
                        <!-- Account details card-->
                        <div class="card mb-4">
                            <div class="card-header">Informasi Akun</div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('update-profileadmin') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="avatar">Ubah Gambar Profile</label> <br>
                                        <input type="file" id="avatar" name="avatar"
                                            accept="image/png, image/jpeg" />
                                    </div>

                                    <div class="row gx-3 mb-3">
                                        <input type="file" id="foto" name="foto" style="display: none"
                                            accept="image/png, image/jpeg">
                                        <div class="col-md-6 mt-2">
                                            <label class="small mb-1" for="nama">Nama Pengguna</label><sup
                                                class="text-danger">*</sup>
                                            <input class="form-control" id="nama" name="nama" type="text"
                                                value="{{ $user->name }}" required>
                                        </div>
                                        <div class="col-md-6 mt-2">
                                            <label class="small mb-1" for="email">Email</label><sup
                                                class="text-danger">*</sup>
                                            <input class="form-control" id="email" name="email" type="email"
                                                value="{{ $user->email }}" required>
                                        </div>
                                    </div>

                                    <div class="row gx-3 mb-3">
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="old_password">Password Lama</label><sup
                                                class="text-danger">*</sup>
                                            <input class="form-control" id="old_password" name="old_password"
                                                type="password" autocomplete="off" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="new_password">Password Baru</label>
                                            <input class="form-control" id="new_password" name="new_password"
                                                type="password" autocomplete="off">
                                        </div>
                                    </div>

                                    <button class="btn btn-primary" type="submit">Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    </div>
@endsection

@section('addJS')
@endsection
