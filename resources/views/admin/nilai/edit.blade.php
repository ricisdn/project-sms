@extends('layouts.master-admin')
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
                <form action="{{ route('update-nilaiadm', ['id' => $nilai->id]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="mapel" class="form-label">Mata Pelajaran</label>
                        <select name="mapel" class="form-control" required>
                            @foreach ($daftar_mapel as $mapel)
                                <option value="{{ $mapel->id }}" @if ($nilai->id_mapel == $mapel->id) selected @endif>
                                    {{ $mapel->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="siswa" class="form-label">Nama Siswa</label>
                        <select name="siswa" class="form-control" required>
                            @foreach ($daftar_siswa as $siswa)
                                <option value="{{ $siswa->id }}" @if ($nilai->id_siswa == $siswa->id) selected @endif>
                                    {{ $siswa->nama }}</option>
                            @endforeach
                        </select>
                    </div>

               

                    <div class="mb-3">
                        <label for="nilai" class="form-label">Nilai</label>
                        <input type="text" name="nilai" class="form-control" autocomplete="off"
                        value="{{ $nilai->nilai}}">
                    </div>
                    <div class="text-right">
                        <a href="{{ route('nilaiadm') }}" class="btn btn-outline-secondary mr-2" role="button">Batal</a>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
