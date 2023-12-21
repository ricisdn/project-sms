@extends('layouts.master-siswa')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Submit Tugas</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('siswa') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('tugas-siswa') }}">Tugas</a></li>
                            <li class="breadcrumb-item active">Submit Tugas</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <div class="card p-4" style="margin: 20px;">
            <div class="container-fluid">
                <form action="{{ route('submit-tugas') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="tugas" class="form-control" value="{{ $tugas->id }}">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <select name="nama" class="form-control" required>
                            @foreach ($siswa as $siswa)
                                <option value="{{ $siswa->id_user }}">{{ $siswa->user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="mapel" class="form-label">Mata Pelajaran</label>
                        <select name="mapel" class="form-control" required>
                            <option value="{{ $tugas->id_mapel }}">{{ $tugas->mapel->nama_mapel }}</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="kelas" class="form-label">Kelas</label>
                        <select name="kelas" class="form-control" required>
                            <option value="{{ $tugas->id_kelas }}">{{ $tugas->kelas->nama_kelas }}</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="catatan" class="form-label">Catatan</label><sup>(optional)</sup>
                        <input type="text" name="catatan" class="form-control" autocomplete="off"
                            placeholder="Masukkan catatan..">
                    </div>
                    <div class="mb-3">
                        <label for="file">Upload File</label> <br>
                        <input type="file" id="file" name="file" />
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>

    </div>
@endsection
