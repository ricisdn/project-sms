@extends('layouts.master-admin')

@section('css')
    <style>
        .content-wrapper {
            background: url('https://i.ibb.co/vPRm5gz/bg5.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
        }
    </style>
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h1 class="m-0">Update Data</h1>
                    </div><!-- /.col -->

                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">Home</li>
                            <li class="breadcrumb-item active"><a href="#">Update Data Role Akses</a></li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <div class="card p-4" style="margin: 20px;">
            <div class="container-fluid">
                <form action="{{ route('update-roleaksesadm', ['id' => $user->id]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf



                    <div class="mb-3">
                        <label for="name">Nama Role Akses</label>
                        <input type="text" name="name" id="name" class="form-control" autocomplete="off"
                            value="{{ $user->name }}">
                    </div>

                    <div class="mb-3">
                        <label for="usertype" class="form-label">Usertype</label>
                        <input type="text" name="usertype" class="form-control" autocomplete="off"
                            value="{{ $user->usertype }}">
                    </div>



                    <div class="text-right">
                        <a href="{{ route('roleaksesadm') }}" class="btn btn-outline-secondary mr-2"
                            role="button">Batal</a>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
