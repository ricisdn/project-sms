@extends('layouts.master-guru')

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
                            <li class="breadcrumb-item active"><a href="#">Update Data Siswa</a></li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <div class="card p-4" style="margin: 20px;">
            <div class="container-fluid">
                <form action="{{ route('update-siswa', ['id' => $siswa->id]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="avatar">Ubah Gambar</label> <br>
                        <input type="file" id="avatar" name="avatar" accept="image/png, image/jpeg" />
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control" autocomplete="off"
                            value="{{ $nama_siswa }}" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="kelas" class="form-label">Kelas</label>
                        <select name="kelas" class="form-control" required>
                            @foreach ($daftar_kelas as $kelas)
                                <option value="{{ $kelas->id }}" @if ($siswa->id_kelas == $kelas->id) selected @endif>
                                    {{ $kelas->nama_kelas }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                        <input type="date" name="tgl_lahir" id="tgl_lahir" class="form-control" autocomplete="off"
                            value="{{ $siswa->tgl_lahir }}">
                    </div>
                    <div class="mb-3">
                        <label for="telepon" class="form-label">Telepon</label>
                        <input type="text" name="telepon" id="telepon" class="form-control" autocomplete="off"
                            value="{{ $siswa->nomor_telepon }}">
                    </div>
                    <div class="mb-3">
                        <label for="gender" class="form-label">Jenis Kelamin</label>
                        <input type="text" name="gender" id="gender" class="form-control" autocomplete="off"
                            value="{{ $siswa->jenis_kelamin }}">
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" name="alamat" id="alamat" class="form-control" autocomplete="off"
                            value="{{ $siswa->alamat }}">
                    </div>

                    <button class="btn btn-secondary">
                        <a href="{{ route('siswa') }}" class="text-white text-decoration-none">Cancel</a>
                    </button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>

    </div>
@endsection
