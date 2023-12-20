@extends('layouts.master-admin')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row p-2">
                    <div class="col-sm-6">
                        <h5 class="m-0">Halaman Data Jadwal</h5>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active"><a href="{{ url('admin') }}">Dashboard</a></li>
                            <li class="breadcrumb-item ">Data Jadwal</li>
                        </ol>
                    </div>
                </div>

                {{-- Konten Data --}}
                <div class="card p-4 m-2">
                    <div class="row">
                        <div class="col-6">
                            <h5>Data Jadwal</h5>
                        </div>
                        <div class="col-6">
                            <div class="float-right mb-3">
                                <a class="btn btn-outline-primary"><i class="fas fa-download"></i>
                                    Download</a>
                                <!-- <a href="{{ route('tambah-mapeladm') }}" class="btn btn-primary"><i
                                        class="fas fa-plus"></i></a> -->
                            </div>
                        </div>
                    </div>
                    <div style="overflow-x: auto;">
                        <table class="table-striped" id="table" style="min-width: 800px;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                  
                                    <th>Nama Guru</th>
                                    <th>Nama Mata Pelajaran</th>
                                    <th>Kelas</th>
                                    <th>Hari</th>
                                    <th>Jam Mulai</th>
                                    <th>Jam Selesai</th>
                                    <th>Aksi</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jadwal as $row)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                       
                                        <td>{{ $row->user ? $row->user->name : 'Belum ada guru' }}</td>
                                        <td>{{ $row->nama }}</td>
                                        <td>{{ $row->kelas ? $row->kelas->nama : 'Belum ada kelas' }}</td>
                                        <td> {{ $row->hari }}</td>
                                        <td> {{ $row->jam_mulai }}</td>
                                        <td> {{ $row->jam_selesai }}</td>
                                        <!-- <td>{{ $row->mapel ? $row->mapel->nama : 'Belum ada mapel' }}</td>
                                        <td>{{ $row->mapel ? $row->mapel->hari : 'Belum ada hari' }}</td>
                                        <td>{{ $row->mapel ? $row->mapel->jam_mulai : 'Belum ada jam mulai' }}</td>
                                        <td>{{ $row->mapel ? $row->mapel->jam_selesai : 'Belum ada jam selesai' }}</td> -->
                                        
                                        <td>
                                            <a href="{{ route('update-mapeladm', ['id' => $row->id]) }}"
                                                class="btn btn-warning btn-sm" role="button">Edit</a>
                                            <button type="button" class="btn btn-danger btn-sm deletebtn"
                                                data-id="{{  $row->id }}">Hapus</button>
                                            
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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
        $('#table').DataTable();
    </script>


   
@endsection
