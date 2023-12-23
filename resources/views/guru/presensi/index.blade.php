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
    Halaman Presensi Siswa
@endsection

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
                            <li class="breadcrumb-item">Home</li>
                            <li class="breadcrumb-item active"><a href="#">Presensi Siswa</a></li>
                        </ol>
                    </div>
                </div>

                {{-- Konten Data --}}
                <div class="card p-4 m-2" style="overflow-x: auto; max-width: 100%; overflow-y: auto;">
                    <div class="row">
                        <div class="col-8">
                            <h5>Data Presensi Siswa</h5>
                            <input type="date" class="mt-2 mb-2 p-2 bg-dark" id="filter_tgl">
                            <select class="form-select mt-2 mb-2 p-2 bg-dark" id="filter_mapel">
                                <option value="">--- semua mapel ---</option>
                                @foreach ($daftar_mapel as $mapel)
                                    <option value="{{ $mapel->nama_mapel }}">{{ $mapel->nama_mapel }}</option>
                                @endforeach
                            </select>
                            <button id="refresh" style="font-weight: bold; font-size: 12px">REFRESH</button>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="float-right mb-3">
                                <button id="printBtn" class="btn btn-success">Print Data</button>
                                <a href="{{ url('tambah-presensi') }}" class="btn btn-primary"><i
                                        class="fas fa-plus"></i></a>
                            </div>
                        </div>
                    </div>
                    <div style="overflow-x: auto;">
                        <table class="table-striped" id="table" style="width: 100%; min-width: 640px;">
                            <thead>
                                <tr class="bg-dark">
                                    <th>No</th>
                                    <th class="d-none">#</th>
                                    <th>Tanggal</th>
                                    <th>Mapel</th>
                                    <th>Nama Siswa</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($presensi as $row)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $row->tgl_presensi }}</td>
                                        <td>{{ date('j F Y', strtotime($row->tgl_presensi)) }}</td>
                                        <td>{{ $row->mapel ? $row->mapel->nama_mapel : 'Belum ada Mapel' }}</td>
                                        <td>{{ $row->user ? $row->user->name : 'Belum ada Siswa' }}</td>
                                        <td
                                            class="{{ app('App\Http\Controllers\PresensiController')->StatusWarna($row->status) }}">
                                            {{ $row->status }}</td>

                                        <td>
                                            <a href="{{ route('update-presensi', ['id' => $row->id]) }}"
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
            var dataTable = $('#table').DataTable({
                "columnDefs": [{
                    "targets": [1], // index of the "#" column
                    "visible": false,
                    "searchable": true
                }]
            });

            var pilihtanggal = $('#filter_tgl');
            var pilihmapel = $('#filter_mapel');

            pilihtanggal.change(function() {
                filter();
            });

            pilihmapel.change(function() {
                filter();
            });

            function filter() {
                var tanggal = pilihtanggal.val();
                var mapel = pilihmapel.val();

                dataTable.column(1).search(tanggal).draw();
                selectMapel(mapel);
            }

            function selectMapel(id_mapel) {
                dataTable.column(3).search(id_mapel).draw();
            }


            $('#refresh').click(function() {
                location.reload();
            });


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
                        $.post('{{ route('index', ['id' => '__id__']) }}'.replace('__id__',
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

            function download() {
                var print = $('#table').clone();
                print.find('th:last-child, td:last-child').remove();
                var printWindow = window.open('', '_blank');
                printWindow.document.write('<html><head><title>Print</title></head><body>');
                printWindow.document.write('<h1>Rekapitulasi Data Presensi</h1>');
                printWindow.document.write(
                    '<table border=1 style="border-collapse:collapse; width: 100%; text-align: center;">' +
                    print
                    .html() + '</table>');
                printWindow.document.write('</body></html>');

                printWindow.document.close();
                printWindow.print();
            }

            $('#printBtn').on('click', function() {
                download();
            });

            $('#table').DataTable();
        });
    </script>
@endsection
