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
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Tambah Data</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">Data Orang Tua</li>
                            <li class="breadcrumb-item active"><a href="{{ route('tambah-ortuadm') }}">Tambah Orang Tua</a>
                            </li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <div class="card p-4" style="margin: 20px;">
            <div class="container-fluid">
                <form action="{{ url('tambah-ortuadm') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="ortu" class="form-label">Nama Orang Tua</label>
                        <select name="ortu" class="form-control" required>
                            <option value="" disabled selected>--- Pilih Nama Ortu ---</option>
                            @foreach ($daftar_ortu as $ortu)
                                <option value="{{ $ortu->id }}">{{ $ortu->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="siswa" class="form-label">ID Siswa</label>
                        <select name="siswa" class="form-control" required>
                            <option value="" disabled selected>--- Pilih Nama Siswa ---</option>
                            @foreach ($daftar_siswa as $siswa)
                                <option value="{{ $siswa->id }}">{{ $siswa->id_user }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="tgl_lahir" class="form-label">Tanggal Lahir Orang Tua</label>
                        <input type="date" name="tgl_lahir" class="form-control" autocomplete="off"
                            placeholder="Masukkan Tanggal Lahir Orang Tua.." required>
                    </div>
                    <div class="mb-3">
                        <label for="telepon" class="form-label">Telepon</label>
                        <input type="text" name="telepon" class="form-control" autocomplete="off"
                            placeholder="Masukkan Nomor Telepon Orang Tua.." required>
                    </div>
                    <div class="mb-3">
                        <label for="gender" class="form-label">Jenis Kelamin</label>
                        <select name="gender" class="form-control" required>
                            <option value="" disabled selected>--- Pilih Jenis Kelamin ---</option>
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" name="alamat" class="form-control" autocomplete="off"
                            placeholder="Masukkan Alamat Orang Tua.." required>
                    </div>
                    <div class="text-right">
                        <a href="{{ route('ortuadm') }}" class="btn btn-outline-secondary mr-2" role="button">Batal</a>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
