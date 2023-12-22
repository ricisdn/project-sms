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
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row p-2">
                    <div class="col-sm-6">
                        <h5 class="m-0">Halaman Data Tugas</h5>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">Home</li>
                            <li class="breadcrumb-item active"><a href="#">Data Tugas</a></li>
                        </ol>
                    </div>
                </div>

                {{-- Konten Data --}}
                <div class="card p-4 m-2" style="overflow-x: auto; max-width: 100%; overflow-y: auto;">

                    <h5>Data Tugas</h5>
                    <div class="row">
                        <div class="col-12">
                            <select class="form-select mt-2 p-2 bg-dark" id="filter_tugas">
                                <option value="">-- semua tugas --</option>
                                @foreach ($tugas as $deskripsi)
                                    <option value="{{ $deskripsi->deskripsi }}">{{ $deskripsi->deskripsi }}</option>
                                @endforeach
                            </select>
                            <select class="form-select mt-2 p-2 bg-dark" id="filter_kelas">
                                <option value="">-- semua kelas --</option>
                                @foreach ($daftar_kelas as $kelas)
                                    <option value="{{ $kelas->nama_kelas }}">{{ $kelas->nama_kelas }}</option>
                                @endforeach
                            </select>
                            <select class="form-select mt-2 mb-2 p-2 bg-dark" id="filter_mapel">
                                <option value="">--- semua mapel ---</option>
                                @foreach ($daftar_mapel as $mapel)
                                    <option value="{{ $mapel->nama_mapel }}">{{ $mapel->nama_mapel }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="float-right mb-3">
                                <button id="printBtn" class="btn btn-success">Print Data</button>
                                <a href="{{ url('tambah-tugas') }}" class="btn btn-primary"><i class="fas fa-plus"></i></a>
                            </div>
                        </div>
                    </div>
                    <div style="overflow-x: auto;">
                        <table class="table-striped" id="table" style="min-width: 850px;">
                            <thead>
                                <tr class="bg-dark">
                                    <th>No</th>
                                    <th>Deskripsi</th>
                                    <th>Kelas</th>
                                    <th>Mata Pelajaran</th>
                                    <th>Deadline</th>
                                    <th>File</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tugas as $row)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $row->deskripsi }}</td>
                                        <td>{{ $row->kelas ? $row->kelas->nama_kelas : 'Belum ada kelas' }}</td>
                                        <td>{{ $row->mapel ? $row->mapel->nama_mapel : 'Belum ada mapel' }}</td>
                                        <td>{{ date('j F Y', strtotime($row->tgl_pengumpulan)) }}</td>
                                        <td><a href="{{ asset('uploads/tugas/' . $row->file) }}"
                                                target="_blank">{{ $row->file }}</a></td>
                                        <td>
                                            <a href="{{ route('update-tugas', ['id' => $row->id]) }}"
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
            table = $('#table').DataTable();

            $('#filter_tugas').change(function() {
                var pilihtugas = $(this).val();
                table.column(1).search(pilihtugas).draw();
            });

            $('#filter_kelas').change(function() {
                var pilihkelas = $(this).val();
                table.column(2).search(pilihkelas).draw();
            });

            $('#filter_mapel').change(function() {
                var pilihmapel = $(this).val();
                table.column(3).search(pilihmapel).draw();
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
                        $.post('{{ route('delete', ['id' => '__id__']) }}'.replace('__id__',
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
                printWindow.document.write('<h1>Rekapitulasi Data Tugas</h1>');
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
