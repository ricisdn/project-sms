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
                            <li class="breadcrumb-item active"><a href="#">Update Data Mata Pelajaran</a></li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <div class="card p-4" style="margin: 20px;">
            <div class="container-fluid">
                <form action="{{ route('update-mapeladm', ['id' => $mapel->id]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="guru" class="form-label">Guru</label>
                        <select name="guru" class="form-control" required>
                            <option value="" disabled selected>--- Pilih Nama Guru ---</option>
                            @foreach ($daftar_user as $guru)
                                <option value="{{ $guru->id }}">{{ $guru->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="mapel" class="form-label">Nama Mata Pelajaran</label>
                        <input type="text" id="mapel" name="mapel" class="form-control"
                            value="{{ $mapel->nama_mapel }}">
                    </div>
                    <div class="mb-3">
                        <label for="kelas" class="form-label">Kelas</label>
                        <select name="kelas" class="form-control" required>
                            @foreach ($daftar_kelas as $kelas)
                                <option value="{{ $kelas->id }}" @if ($mapel->id_kelas == $kelas->id) selected @endif>
                                    {{ $kelas->nama_kelas }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="hari" class="form-label">Hari</label>
                        <input type="text" name="hari" id="hari" class="form-control" autocomplete="off"
                            value="{{ $mapel->hari }}">
                    </div>

                    <div class="mb-3">
                        <label for="jam_mulai" class="form-label">Jam Mulai</label>
                        <input type="time" name="jam_mulai" id="jam_mulai" class="form-control" autocomplete="off"
                            value="{{ $mapel->jam_mulai }}">
                    </div>

                    <div class="mb-3">
                        <label for="jam_selesai" class="form-label">Jam Selesai</label>
                        <input type="time" name="jam_selesai" id="jam_selesai" class="form-control" autocomplete="off"
                            value="{{ $mapel->jam_selesai }}">
                    </div>


                    <div class="text-right">
                        <a href="{{ route('mapeladm') }}" class="btn btn-outline-secondary mr-2" role="button">Batal</a>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
