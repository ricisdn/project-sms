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
                            <li class="breadcrumb-item active"><a href="#">Update Tugas</a></li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <div class="card p-4" style="margin: 20px;">
            <div class="container-fluid">
                <form action="{{ route('update-tugasadm', ['id' => $tugas->id]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <input type="text" name="deskripsi" id="deskripsi" class="form-control" autocomplete="off"
                            value="{{ $tugas->deskripsi }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="kelas" class="form-label">Kelas</label>
                        <select name="kelas" class="form-control" required>
                            @foreach ($daftar_kelas as $kelas)
                                <option value="{{ $kelas->id }}" @if ($tugas->id_kelas == $kelas->id) selected @endif>
                                    {{ $kelas->nama_kelas }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="mapel" class="form-label">Mata Pelajaran</label>
                        <select name="mapel" class="form-control" required>
                            @foreach ($daftar_mapel as $mapel)
                                <option value="{{ $mapel->id }}" @if ($tugas->id_mapel == $mapel->id) selected @endif>
                                    {{ $mapel->nama_mapel }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="deadline" class="form-label">Tanggal Pengumpulan</label>
                        <input type="date" name="deadline" id="deadline" class="form-control" autocomplete="off"
                            value="{{ $tugas->tgl_pengumpulan }}">
                    </div>

                    <div class="mb-3">
                        <label for="file">Ubah File</label> <br>
                        <input type="file" id="file" name="file" />
                    </div>
                    <div class="text-right">
                        <a href="{{ route('tugasadm') }}" class="btn btn-outline-secondary mr-2" role="button">Batal</a>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
