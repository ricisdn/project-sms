@extends('layouts.master-siswa')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-wrapper" style="background-color: #ddd">
        <!-- /.content-header -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Jadwal Pelajaran</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('siswa') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Jadwal Pelajaran</li>
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
                    @if ($mapel->isEmpty())
                            <div class="alert alert-danger" role="alert">
                                <strong>Error.</strong> No data found.
                            </div>
                            @else
                        <table id="jadwal-table" class="table table-hover table-bordered mb-0" style="min-width">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Mata Pelajaran</th>
                                        <th>Guru</th>
                                        <th>Hari</th>
                                        <th>Jam Mulai</th>
                                        <th>Jam Selesai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($mapel as $mapel)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $mapel->nama_mapel }}</td>
                                            <td>{{ $mapel->user ? $mapel->user->name : 'Belum ada Siswa' }}</td>
                                            <td>{{ $mapel->hari }}</td>
                                            <td>{{ $mapel->jam_mulai }}</td>
                                            <td>{{ $mapel->jam_selesai }}</td>
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
            $('#jadwal-table').DataTable();
        });
    </script>
@endsection
