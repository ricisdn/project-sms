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

@section('title')
    Dashboard Guru
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
                                <h3 class="card-title">Record Jejak Pengumpulan Tugas</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <canvas id="myChart" width="auto" height="200"></canvas>
                            </div>
                        </div>
                    </div>

                    {{-- View Table Mengajar --}}
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

@section('addJS')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        var ctx = document.getElementById('myChart').getContext('2d');

        var months = @json($months);
        var submissions = @json($submissions);

        // Array warna untuk setiap bulan
        var listwarna = ['rgba(75, 192, 192, 0.2)', 'rgba(255, 99, 132, 0.2)', 'rgba(255, 205, 86, 0.2)',
            'rgba(54, 162, 235, 0.2)', 'rgba(153, 102, 255, 0.2)', 'rgba(255, 159, 64, 0.2)',
            'rgba(255, 99, 132, 0.2)', 'rgba(255, 205, 86, 0.2)', 'rgba(54, 162, 235, 0.2)',
            'rgba(153, 102, 255, 0.2)', 'rgba(255, 159, 64, 0.2)', 'rgba(75, 192, 192, 0.2)'
        ];

        // Membuat array bulan
        var bulan = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October",
            "November", "December"
        ];

        // Membuat array warna yang sesuai dengan jumlah bulan
        var warna = bulan.map(function(bulan) {
            var index = months.indexOf(bulan);
            return index !== -1 ? listwarna[index] : 'rgba(0, 0, 0, 0.2)';
        });


        // Mengisi nilai 0 untuk bulan yang belum memiliki data
        var filledSubmissions = [];
        for (var i = 0; i < bulan.length; i++) {
            var index = months.indexOf(bulan[i]);
            if (index !== -1) {
                filledSubmissions.push(submissions[index]);
            } else {
                filledSubmissions.push(0);
            }
        }

        // Memberi warna yang berbeda, setiap bulan
        var datasets = [{
            label: 'Jumlah Pengumpulan',
            data: filledSubmissions,
            backgroundColor: warna,
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        }];

        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: bulan,
                datasets: datasets
            },
            options: {
                scales: {
                    x: {
                        beginAtZero: true
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                            min: 0
                        }
                    }
                },
                indexAxis: 'x',
                plugins: {
                    legend: {
                        display: false,
                        position: 'top'
                    }
                },
                layout: {
                    padding: {
                        left: 10,
                        right: 10,
                        top: 10,
                        bottom: 10
                    }
                },
                responsive: true,
                maintainAspectRatio: false,
                categoryPercentage: 0.8,
                barPercentage: 0.8
            }
        });
    </script>
@endsection
