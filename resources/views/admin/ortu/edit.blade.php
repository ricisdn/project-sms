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
                            <li class="breadcrumb-item active"><a href="#">Update Data Orang Tua</a></li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <div class="card p-4" style="margin: 20px;">
            <div class="container-fluid">
                <form action="{{ route('update-ortuadm', ['id' => $ortu->id]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="avatar">Ubah Gambar</label> <br>
                        <input type="file" id="avatar" name="avatar" accept="image/png, image/jpeg" />
                    </div>
                    <div class="mb-3">
                        <label for="ortu" class="form-label">Nama Orangtua</label>
                        <!-- <input type="text" name="ortu" class="form-control" placeholder="Masukkan Nama Orang Tua..">  -->
                        <input type="text" name="ortu" id="ortu" class="form-control" autocomplete="off"
                            value="{{ App\User::find($ortu->id_user)->name }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="siswa" class="form-label">ID Siswa</label>
                        <select name="siswa" class="form-control" required>
                            <option value="" disabled selected>--- Pilih Nama Siswa ---</option>
                            @foreach ($daftar_siswa as $siswa)
                                <option value="{{ $siswa->id }}">{{ $siswa->id }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                        <input type="date" name="tgl_lahir" id="tgl_lahir" class="form-control" autocomplete="off"
                            value="{{ $ortu->tgl_lahir }}">
                    </div>
                    <div class="mb-3">
                        <label for="telepon" class="form-label">Telepon</label>
                        <input type="text" name="telepon" id="telepon" class="form-control" autocomplete="off"
                            value="{{ $ortu->nomor_telepon }}">
                    </div>
                    <div class="mb-3">
                        <label for="gender" class="form-label">Jenis Kelamin</label>
                        <input type="text" name="gender" id="gender" class="form-control"
                            value="{{ $ortu->jenis_kelamin }}">
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" name="alamat" id="alamat" class="form-control" autocomplete="off"
                            value="{{ $ortu->alamat }}">
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>

    </div>
@endsection
