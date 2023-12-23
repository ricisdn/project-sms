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
    Halaman Data Siswa
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row p-2">
                    <div class="col-sm-6">
                        <h5 class="m-0">Halaman Data Siswa</h5>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">Home</li>
                            <li class="breadcrumb-item active"><a href="#">Data Siswa</a></li>
                        </ol>
                    </div>
                </div>

                {{-- Konten Data --}}
                <div class="card p-4 m-2">
                    <div class="row">
                        <div class="col-8">
                            <h5>Data Siswa</h5>
                            <div class="mb-3" style="width: 135px">
                                <select class="form-control bg-dark" id="filter_kelas">
                                    <option value="">-- Semua Kelas --</option>
                                    @foreach ($daftar_kelas as $kelas)
                                        <option value="{{ $kelas->nama_kelas }}">{{ $kelas->nama_kelas }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="float-right mb-3">
                                <button id="printBtn" class="btn btn-success">Print Data</button>
                                <a href="{{ route('tambah-siswa') }}" class="btn btn-primary"><i
                                        class="fas fa-plus"></i></a>
                            </div>
                        </div>
                    </div>
                    <div style="overflow-x: auto;">
                        <table class="table-striped" id="table" style="min-width: 950px;">
                            <thead>
                                <tr class="bg-dark">
                                    <th>No</th>
                                    <th>Foto</th>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Nomor Telepon</th>
                                    <th>Alamat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($siswa as $row)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>
                                            @if ($row->foto)
                                                <img src="{{ asset('uploads/siswa/' . $row->foto) }}" {{ $row->nama }}
                                                    style="width: 50px; height: 50px; border-radius: 50px;">
                                            @else
                                                No Photo
                                            @endif
                                        </td>
                                        <td>{{ $row->user ? $row->user->name : 'Tidak diketahui' }}</td>
                                        <td>{{ $row->kelas ? $row->kelas->nama_kelas : 'Belum ada kelas' }}</td>
                                        <td>{{ date('j F Y', strtotime($row->tgl_lahir)) }}</td>
                                        <td>{{ $row->jenis_kelamin }}</td>
                                        <td>{{ $row->nomor_telepon }}</td>
                                        <td>{{ $row->alamat }}</td>
                                        <td>
                                            <a href="{{ route('update-siswa', ['id' => $row->id]) }}"
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
        function download() {
            var print = $('#table').clone();
            print.find('th:nth-child(2), td:nth-child(2), th:last-child, td:last-child').remove();
            var printWindow = window.open('', '_blank');
            printWindow.document.write('<html><head><title>Print</title></head><body>');
            printWindow.document.write('<h1>Rekapitulasi Data Siswa</h1>');
            printWindow.document.write(
                '<table border=1 style="border-collapse:collapse; width: 100%; text-align: center;">' + print
                .html() + '</table>');
            printWindow.document.write('</body></html>');

            printWindow.document.close();
            printWindow.print();
        }

        $(document).ready(function() {
            table = $('#table').DataTable();

            $('#filter_kelas').change(function() {
                var pilihkelas = $(this).val();
                table.column(3).search(pilihkelas).draw();
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
                        $.post('{{ route('delete-siswa', ['id' => '__id__']) }}'.replace(
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


            // Initialize DataTable
            $('#table').DataTable();

            $('#printBtn').on('click', function() {
                download();
            });
        });
    </script>
@endsection
