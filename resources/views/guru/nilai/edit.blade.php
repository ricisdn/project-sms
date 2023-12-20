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
                        <label for="siswa" class="form-label">Nama</label>
                        <select name="siswa" class="form-control" required>
                            @foreach ($daftar_siswa as $siswa)
                                <option value="{{ $siswa->id }}" @if ($tugas->id_kelas == $kelas->id) selected @endif>
                                    {{ $siswa->nama }}</option>
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

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>

    </div>
@endsection
