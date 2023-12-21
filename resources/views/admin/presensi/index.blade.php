@extends('layouts.master-admin')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row p-2">
                    <div class="col-sm-6">
                        <h5 class="m-0">Halaman Data Presensi Siswa</h5>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active"><a href="{{ url('admin') }}">Dashboard</a></li>
                            <li class="breadcrumb-item ">Presensi Siswa</li>
                        </ol>
                    </div>
                </div>

                {{-- Konten Data --}}
                <div class="card p-4 m-2" style="overflow-x: auto; max-width: 100%; overflow-y: auto;">
                    <div class="row">
                        <div class="col-6">
                            <h5>Data Presensi Siswa</h5>
                        </div>
                        <div class="col-6">
                            <div class="float-right mb-3">
                                <a class="btn btn-outline-primary"><i class="fas fa-download"></i>
                                    Download</a>
                                <a href="{{ url('tambah-presensiadm') }}" class="btn btn-primary"><i
                                        class="fas fa-plus"></i></a>
                            </div>
                        </div>
                    </div>
                    <div style="overflow-x: auto;">
                        <table class="table-striped" id="table" style="width: 100%; min-width: 640px;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Mapel</th>
                                    <th>Nama Siswa</th>
                                    <th>Status</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($presensi as $row)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $row->tgl_presensi }}</td>
                                        <td>{{ $row->mapel ? $row->mapel->nama_mapel : 'Belum ada Mapel' }}</td>
                                        <td>{{ $row->user ? $row->user->name : 'Belum ada Siswa' }}</td>
                                        <td
                                            class="{{ app('App\Http\Controllers\PresensiController')->StatusWarnaadm($row->status) }}">
                                            {{ $row->status }}
                                        </td>
                                        <td>{{ $row->keterangan ? $row->keterangan : 'Tidak ada Keterangan' }}</td>
                                        <td>
                                            <a href="{{ route('update-presensiadm', ['id' => $row->id]) }}"
                                                class="btn btn-warning btn-sm" role="button">Edit</a>
                                            <button type="button" class="btn btn-danger btn-sm deletebtn"
                                                data-id="{{ $row->id }}">Hapus</button>
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
        $(document).ready(function() {
            $('.deletebtn').click(function(e) {
                e.preventDefault();
                var id = $(this).data('id');

                Swal.fire({
                    title: "Apakah anda yakin?",
                    text: "Data yang sudah dihapus, tidak bisa dipulihkan!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then(function(result) {
                    if (result.isConfirmed) {
                        $.post('{{ route('delete-presensiadm', ['id' => '__id__']) }}'.replace(
                                '__id__',
                                id), {
                                '_token': '{{ csrf_token() }}',
                                'id': id
                            },
                            function(response) {
                                Swal.fire({
                                    title: "Deleted!",
                                    text: "Data berhasil dihapus!",
                                    icon: "success"
                                });

                                // Timer sebelum refresh halaman
                                setTimeout(function() {
                                    window.location.href = window.location.href;
                                }, 1000);
                            }).fail(function(error) {
                            console.error('Error deleting record: ', error);
                        });
                    }
                });
            });

            $('#table').DataTable();
        });
    </script>
@endsection
