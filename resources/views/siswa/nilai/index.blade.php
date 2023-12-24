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
    Halaman Nilai Siswa
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row p-2">
                    <div class="col-sm-6">
                        <h5 class="m-0">Halaman Data Nilai</h5>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">Home</li>
                            <li class="breadcrumb-item active"><a href="#">Nilai Siswa</a></li>
                        </ol>
                    </div>
                </div>

                {{-- Konten Data --}}
                <div class="card p-4 m-2" style="overflow-x: auto; max-width: 100%; overflow-y: auto;">
                    <div class="row">
                        <div class="col-6">
                            <h5>Data Nilai</h5>
                        </div>
                        <div class="col-6">
                            <div class="float-right mb-3">
                                <a class="btn btn-outline-primary"><i class="fas fa-download"></i>
                                    Download</a>
                            </div>
                        </div>
                    </div>
                    <div style="overflow-x: auto;">
                        @if ($pengumpulan->isEmpty())
                            <div class="alert alert-danger" role="alert">
                                <i data-lucide="badge-info"></i> <b>Error:</b> No data found.
                            </div>
                        @else
                            <table class="table-striped table-bordered" id="table" style="min-width: 800px;">

                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Siswa</th>
                                        <th>Mata Pelajaran</th>
                                        <th>Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pengumpulan as $pengumpulan)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $pengumpulan->user ? $pengumpulan->user->name : 'Belum ada Siswa' }}</td>
                                            <td>{{ $pengumpulan->mapel ? $pengumpulan->mapel->nama_mapel : 'Belum ada Mapel' }}
                                            </td>
                                            <td>{{ $pengumpulan->nilai }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('addJS')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $('#table').DataTable();
        });
    </script>
@endsection
