@extends('layouts.master-guru')
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
                            <li class="breadcrumb-item active"><a href="#">Data Nilai</a></li>
                        </ol>
                    </div>
                </div>

                {{-- Konten Data --}}
                <div class="card p-4 m-2" style="overflow-x: auto; max-width: 100%; overflow-y: auto;">

                    <h5>Data Nilai Siswa</h5>
                    <div class="row">
                        <div class="col-12">
                            <select class="form-select mt-2 p-2 bg-secondary" id="filter_tugas">
                                <option value="">-- semua tugas --</option>
                                @foreach ($status as $deskripsi)
                                    <option value="{{ $deskripsi->deskripsi }}">{{ $deskripsi->deskripsi }}</option>
                                @endforeach
                            </select>
                            <select class="form-select mt-2 p-2 bg-secondary" id="filter_kelas">
                                <option value="">-- semua kelas --</option>
                                @foreach ($daftar_kelas as $kelas)
                                    <option value="{{ $kelas->nama_kelas }}">{{ $kelas->nama_kelas }}</option>
                                @endforeach
                            </select>
                            <select class="form-select mt-2 mb-2 p-2 bg-secondary" id="filter_mapel">
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
                                <a href="{{ route('tambah-nilai') }}" class="btn btn-primary"><i
                                        class="fas fa-plus"></i></a>
                            </div>
                        </div>
                    </div>
                    <div style="overflow-x: auto;">
                        <table class="table-striped" id="table" style="width: 100%; min-width: 650px;">
                            <thead>
                                <tr class="bg-dark">
                                    <th>No</th>
                                    <th>Keterangan</th>
                                    <th>Mata Pelajaran</th>
                                    <th>Nama Siswa</th>
                                    <th>Kelas</th>
                                    <th>Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($nilai as $row)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $row->tugas ? $row->tugas->deskripsi : 'Tidak diketahui' }}</td>
                                        <td>{{ $row->mapel ? $row->mapel->nama_mapel : 'Belum ada mapel' }}</td>
                                        <td>{{ $row->user ? $row->user->name : 'Belum ada Siswa' }}</td>
                                        <td>{{ $row->kelas ? $row->kelas->nama_kelas : 'Belum ada kelas' }}</td>
                                        <td>
                                            @if ($row->nilai)
                                                {{ $row->nilai }}
                                            @else
                                                <span class="badge badge-warning">Belum dinilai</span>
                                            @endif
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
                table.column(4).search(pilihkelas).draw();
            });

            $('#filter_mapel').change(function() {
                var pilihmapel = $(this).val();
                table.column(2).search(pilihmapel).draw();
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
                        $.post('{{ route('delete-nilai', ['id' => '__id__']) }}'.replace('__id__',
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
                var printWindow = window.open('', '_blank');
                printWindow.document.write('<html><head><title>Print</title></head><body>');
                printWindow.document.write('<h1>Rekapitulasi Data Nilai Siswa</h1>');
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
