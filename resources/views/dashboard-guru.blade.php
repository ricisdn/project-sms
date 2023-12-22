@extends('layouts.master-guru')

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
    <div class="content-wrapper" style="background-color: #ddd">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col" style="background-color: white; margin: 8px; padding: 15px; border-radius: 5px">
                        <h1 class="m-0">Selamat Datang, {{ Auth::user()->name }}</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-primary">
                            <div class="inner">
                                <h4 class="text-light fw-bold">Siswa</h4>
                                <h6 class="text-light">
                                    {{ count($siswa) }}
                                </h6>
                            </div>
                            <a href="{{ route('siswa') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-pink">
                            <div class="inner">
                                <h4 class="text-light fw-bold">Kelas</h4>
                                <h6 class="text-light">
                                    {{ count($kelas) }}
                                </h6>
                            </div>
                            <a href="#" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h4 class="text-light fw-bold">Tugas</h4>
                                <h6 class="text-light">
                                    {{ count($tugas) }}
                            </div>
                            <a href="{{ route('tugas') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h4 class="text-light fw-bold">Pengumpulan</h4>
                                <h6 class="text-light">
                                    {{ count($pengumpulan) }}
                                </h6>
                            </div>
                            <a href="{{ route('pengumpulan') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-6">
                        <div class="card">
                            <div class="card-header bg-dark">
                                <h3 class="card-title">Jadwal Mengajar</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div style="overflow-x: auto">
                                    <table class="table table-striped" border="1" style="min-width: 500px">
                                        <tr class="bg-dark">
                                            <td>No</td>
                                            <td>Hari</td>
                                            <td>Mata Pelajaran</td>
                                            <td>Jam Masuk</td>
                                            <td>Jam Keluar</td>
                                        </tr>

                                        @foreach ($mapel as $row)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $row->hari }}</td>
                                                <td>{{ $row->nama_mapel }}</td>
                                                <td>{{ $row->jam_mulai }}</td>
                                                <td>{{ $row->jam_selesai }}</td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>



    </div>
    </div>
    </section>
    </div>
    </div>
@endsection

@section('scripts')
@endsection
