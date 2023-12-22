@extends('layouts.master-orangtua')

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
    <!-- Content Header (Page header) -->
    <div class="content-wrapper" style="background-color: #ddd">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Nilai</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('siswa') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Nilai</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        @if ($nilai->isEmpty())
                            <div class="alert alert-danger" role="alert">
                                <strong>Error.</strong> No data found.
                            </div>
                        @else
                            <table class="table table-hover table-bordered mb-0" id="transkrip-table" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 5%;">No</th>
                                        <th class="text-center" style="width: 35%;">Nama Siswa</th>
                                        <th class="text-center" style="width: 35%;">Mata Pelajaran</th>
                                        <th class="text-center" style="width: 25%;">Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($nilai as $nilai)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $siswa->user->name }}</td>
                                            <td>{{ $nilai->mapel->nama_mapel }}</td>
                                            <td>{{ $nilai->nilai }}</td>
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
    <!-- /.content -->
@endsection

@section('addJS')
    <script>
        $(document).ready(function() {
            $('#transkrip-table').DataTable();
        });
    </script>
@endsection
