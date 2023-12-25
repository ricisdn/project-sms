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

@section('title')
    Halaman Tugas Siswa
@endsection

@section('content')
    <div class="content-wrapper" style="background-color: #ddd">
        <!-- /.content-header -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Daftar Tugas</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('siswa') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Tugas</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body" style="overflow-x:auto;">
                        @if ($tugas->isEmpty())
                            <div class="alert alert-danger" role="alert">
                                <strong>Error.</strong> No data found.
                            </div>
                        @else
                            <table id="table" class="table table-hover table-bordered mb-0" style="min-width">
                                <thead>
                                    <tr>
                                        <th style="width:5%" class="text-center">No</th>
                                        <th style="width:15%" class="text-center">Mata Pelajaran</th>
                                        <th style="width:35%" class="text-center">Deskripsi</th>
                                        <th style="width:15%" class="text-center">Deadline</th>
                                        <th style="width:15%" class="text-center">File Tugas</th>
                                        <th style="width:15%" class="text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tugas as $tugas)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $tugas->mapel->nama_mapel }}</td>
                                            <td>{{ $tugas->deskripsi }}</td>
                                            <td>{{ $tugas->tgl_pengumpulan }}</td>
                                            <td><a href="{{ asset('uploads/tugas/' . $tugas->file) }}"
                                                    target="_blank">{{ $tugas->file }}</a></td>
                                            <td class="text-center">
                                                @php
                                                    $isSubmitted = false;
                                                @endphp

                                                @for ($i = 0; $i < count($pengumpulan); $i++)
                                                    @if ($tugas->id === $pengumpulan[$i]->id_tugas)
                                                        @php
                                                            $isSubmitted = true;
                                                        @endphp
                                                        <a href="" class="btn btn-success disabled">Submitted</a>
                                                    @break
                                                @endif
                                            @endfor

                                            @unless ($isSubmitted)
                                                <a href="{{ route('tambah-tugas-siswa', ['id' => $tugas->id]) }}"
                                                    class="btn btn-danger">Not Submitted</a>
                                            @endunless
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
</div>
@endsection

@section('addJS')
<script>
    $(document).ready(function() {
        $('#table').DataTable();
    });
</script>
@endsection
