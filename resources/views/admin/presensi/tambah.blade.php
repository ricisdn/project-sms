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
                            <li class="breadcrumb-item">Data Presensi</li>
                            <li class="breadcrumb-item active"><a href="{{ route('tambah-presensiadm') }}">Tambah
                                    Presensi</a></li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <div class="card p-4" style="margin: 20px;">
            <div class="container-fluid">
                <form action="{{ url('tambah-presensiadm') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="siswa" class="form-label">Nama Siswa</label>
                        <select name="siswa" class="form-control" required>
                            <option value="" disabled selected>--- Pilih Nama Siswa ---</option>
                            @foreach ($daftar_user as $siswa)
                                <option value="{{ $siswa->id }}">{{ $siswa->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="mapel" class="form-label">Mata Pelajaran</label>
                        <select name="mapel" class="form-control" required>
                            <option value="" disabled selected>--- Pilih Mapel ---</option>
                            @foreach ($daftar_mapel as $mapel)
                                <option value="{{ $mapel->id }}">{{ $mapel->nama_mapel }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" class="form-control" required>
                            <option value="" disabled selected>--- Pilih Status ---</option>
                            <option value="Hadir">Hadir</option>
                            <option value="Sakit">Sakit</option>
                            <option value="Izin">Izin</option>
                            <option value="Alpa">Alpa</option>
                        </select>

                    </div>
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label><sup>(optional)</sup>
                        <input type="text" name="keterangan" class="form-control" autocomplete="off"
                            placeholder="Masukkan Keterangan..">
                    </div>
                    <div class="mb-3">
                        <label for="tgl_presensi" class="form-label">Tanggal Presensi</label>
                        <input type="date" name="tgl_presensi" class="form-control" autocomplete="off" required>
                    </div>

                    <div class="text-right">
                        <a href="{{ route('presensiadm') }}" class="btn btn-outline-secondary mr-2" role="button">Batal</a>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
