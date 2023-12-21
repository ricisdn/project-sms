@extends('layouts.master-orangtua')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-wrapper" style="background-color: #ddd">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Presensi</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('orangtua') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Presensi</li>
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
                    <div class="card-header">
                        <h4>Rekap Kehadiran</h4>
                        <div class="row">

                            <div class="col-md-2">
                                <p class="text-dark">
                                    @if($hadir->isNotEmpty())
                                    Hadir : {{$hadir[0]->Jumlah_Data}}
                                @else
                                Hadir : 0
                                @endif
                            </p>
                            <p class="text-dark">
                                @if($izin->isNotEmpty())
                                Izin : {{$izin[0]->Jumlah_Data}}
                                @else
                                Izin : 0
                                @endif
                            </p>
                        </div>
                        <div class="col-md-2">
                            <p class="text-dark">
                                @if($sakit->isNotEmpty())
                                Sakit : {{$sakit[0]->Jumlah_Data}}
                                @else
                                Sakit : 0
                                @endif
                            </p>
                            <p class="text-dark">
                                @if($alpa->isNotEmpty())
                                Alpa : {{$alpa[0]->Jumlah_Data}}
                                @else
                                Alpa : 0
                                @endif
                            </p>
                        </div>
                    </div>
                    </div>
                    <div class="card-body">
                        @if ($presensi->isEmpty())
                            <div class="alert alert-danger" role="alert">
                                <strong>Error.</strong> No data found.
                            </div>
                            @else
                        <table class="table table-hover table-bordered mb-0" id="presensi-table">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Mapel</th>
                                    <th class="text-center">Nama</th>
                                    <th class="text-center">Tanggal</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Keterangan</th>
                                </tr>
                            </thead>
                                <tbody>
                                    @foreach ($presensi as $presensi)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $presensi->mapel ? $presensi->mapel->nama_mapel : 'Belum ada Siswa' }}</td>
                                            <td>{{ $siswa->user->name }}</td>
                                            <td>{{ $presensi->tgl_presensi }}</td>
                                            <td class="text-center">
                                                <span class="badge {{ $presensi->status == 'Hadir' ? 'badge-success' : 'badge-danger' }}"
                                                    style="width: 5rem;">
                                                    {{ $presensi->status }}
                                                </span>
                                            </td>
                                            <td>{{ $presensi->keterangan }}</td>
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
            $('#presensi-table').DataTable();
        });
    </script>
@endsection
