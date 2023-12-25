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
    Dashboard Siswa
@endsection

@php
    function hariIndonesiaToInggris($hari)
    {
        $map = [
            'Senin' => 'Monday',
            'Selasa' => 'Tuesday',
            'Rabu' => 'Wednesday',
            'Kamis' => 'Thursday',
            'Jumat' => 'Friday',
        ];

        return $map[$hari] ?? null;
    }

    use Carbon\Carbon;
    $todayNameInggris = Carbon::now()->translatedFormat('l');
@endphp

@section('content')
    <div id="error-toast" class="toast bg-danger" role="alert" aria-live="assertive" aria-atomic="true" data-delay="3000"
        style="position: absolute; top: 10; right: 0; z-index: 1000;">
        <div class="toast-header">
            <strong class="mr-auto">Error</strong>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body" id="error-toast-message"></div>
    </div>
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
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ count($mapel) }}</h3>
                                <p>Mata Pelajaran</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{ count($tugas) }}</h3>
                                <p>Daftar Tugas</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ count($pengumpulan) }}</h3>
                                <p>Pengumpulan Tugas</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-secondary">
                            <div class="inner">
                                <h3>{{ count($presensi) }}</h3>
                                <p>Kehadiran</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="card">
                            <div class="card-header">
                                Jadwal Hari Ini
                            </div>
                            <div class="card-body">
                                <!-- Your Jadwal Table Goes Here -->
                                <!-- Example Table -->
                                <table class="table" id="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Jam Mulai</th>
                                            <th scope="col">Jam Selesai</th>
                                            <th scope="col">Mata Pelajaran</th>
                                            <th scope="col">Guru</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($mapel as $mapel)
                                            @if (strtolower($todayNameInggris) == strtolower(hariIndonesiaToInggris($mapel->hari)))
                                                <tr>
                                                    <td>{{ $mapel->jam_mulai }}</td>
                                                    <td>{{ $mapel->jam_selesai }}</td>
                                                    <td>{{ $mapel->nama_mapel }}</td>
                                                    <td>{{ $mapel->user ? $mapel->user->name : 'Tidak diketahui' }}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Tugas Card -->
                    <div class="col-md-5">
                        <div class="card">
                            <div class="card-header">
                                Daftar Tugas
                            </div>
                            <div class="card-body">
                                <table class="table" id="table2">
                                    <thead>
                                        <tr>
                                            <th scope="col">Mata Pelajaran</th>
                                            <th scope="col">Deskripsi Tugas</th>
                                            <th scope="col">Deadline</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($tugas as $tugas)
                                            <tr>
                                                <td>{{ $tugas->mapel->nama_mapel }}</td>
                                                <td>{{ $tugas->deskripsi }}</td>
                                                <td>{{ $tugas->tgl_pengumpulan }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
        </section>


    </div>
@endsection

@section('addJS')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Check for flashed messages and display Bootstrap toast
        $(document).ready(function() {
            @if (Session::has('error'))
                var message = "{{ Session::get('error') }}";

                // Set the toast message
                $('#error-toast-message').text(message);

                // Initialize and show the toast
                var toast = new bootstrap.Toast($('#error-toast'));
                toast.show();
            @endif
        });

        // DataTable initialization
        $('#table').DataTable();
        $('#table2').DataTable();
    </script>
@endsection
