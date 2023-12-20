@extends('layouts.master-guru')

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
                <form action="{{ route('update-tugas', ['id' => $tugas->id]) }}" method="POST"
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
                        <input type="file" id="file" name="file" required />
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>

    </div>
@endsection
