@extends('layouts.master-siswa')

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
                        <h1 class="m-0 text-dark">Edit Tugas</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('siswa') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('tugas-siswa') }}">Tugas</a></li>
                            <li class="breadcrumb-item active">Edit Tugas</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <div class="card p-4" style="margin: 20px;">
            <div class="container-fluid">
                <form action="{{ route('edit-tugas') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="file">File Submit Tugas</label> <br>
                        <a href="{{ asset('uploads/pengumpulan/' . $pengumpulan->file) }}"
                            target="_blank">{{ $pengumpulan->file }}</a>
                    </div>
                    <input type="hidden" name="id_pengumpulan" class="form-control" value="{{ $pengumpulan->id }}">
                    <input type="hidden" name="tugas" class="form-control" value="{{ $tugas->id }}">
                    <div class="mb-3">
                        <label for="file">Ubah File</label> <br>
                        <input type="file" id="file" name="file" />
                    </div>
                    <div class="mb-3">
                        <label for="mapel" class="form-label">Mata Pelajaran</label>
                        <select name="mapel" class="form-control" required>
                            <option value="{{ $pengumpulan->id_mapel }}"selected>{{ $pengumpulan->mapel->nama_mapel }}
                            </option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="siswa" class="form-label">Nama Siswa</label>
                        <select name="siswa" class="form-control" required>
                            <option value="{{ $pengumpulan->id_user }}" selected>{{ $pengumpulan->user->name }}</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="catatan" class="form-label">Catatan</label>
                        <input type="text" name="catatan" id="catatan" class="form-control" autocomplete="off"
                            value="{{ $pengumpulan->catatan }}">
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>

    </div>
@endsection
