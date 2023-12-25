@extends('layouts.master-admin')

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
    Dashboard Admin
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
                    <div class="col-md-4 col-6">
                        <div class="small-box bg-primary">
                            <div class="inner">
                                <h3>
                                    <?php
                                    $count = DB::table('tbl_siswas')->count();
                                    echo "$count";
                                    ?>
                                </h3>
                                <p>Siswa</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag" data-lucide="graduation-cap"></i>
                            </div>
                            <a href="{{ route('siswaadm') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-md-4 col-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>
                                    <?php
                                    $count = DB::table('tbl_orangtuas')->count();
                                    echo "$count";
                                    ?>
                                </h3>
                                <p>Orang Tua</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars" data-lucide="radar"></i>
                            </div>
                            <a href="{{ route('ortuadm') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>

                    </div>

                    <div class="col-md-4 col-6">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>
                                    <?php
                                    $count = DB::table('tbl_gurus')->count();
                                    echo "$count";
                                    ?>
                                </h3>
                                <p>Guru</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars" data-lucide="book-user"></i>
                            </div>
                            <a href="{{ route('guruadm') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-md-4 col-6">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>
                                    <?php
                                    $count = DB::table('tbl_mapels')->count();
                                    echo "$count";
                                    ?>
                                </h3>
                                <p>Mata Pelajaran</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars" data-lucide="book-check"></i>
                            </div>
                            <a href="{{ route('mapeladm') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>

                    </div>

                    <div class="col-md-4 col-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>
                                    <?php
                                    $count = DB::table('tbl_kelass')->count();
                                    echo "$count";
                                    ?>
                                </h3>
                                <p>Kelas</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars" data-lucide="library-square"></i>
                            </div>
                            <a href="{{ route('kelasadm') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>

                    </div>

                    <div class="col-md-4 col-sm-6">
                        <div class="card">
                            <div class="card-header bg-dark">
                                <h3 class="card-title">Kalender</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="calendar"></div>
                            </div>
                        </div>
                    </div>



                </div>
            </div>

            {{-- Penutup --}}
    </div>
    </div>



    </div>
    </div>
    </section>
    </div>
    </div>
@endsection

@section('addJS')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth'
            });
            calendar.render();
        });
    </script>
@endsection
