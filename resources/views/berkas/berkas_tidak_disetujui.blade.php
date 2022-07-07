@extends('layout.template')

@section('content-title', 'Data Surat')

@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            {{ $sub_title }}
                        </div>
                        <div class="card-body">

                            <table id="example1" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Surat</th>
                                        <th>Tgl Terima Surat</th>
                                        <th>Tgl Masuk Surat</th>
                                        <th>Nomor Surat</th>
                                        <th>Tujuan Surat</th>
                                        <th>Perihal Surat</th>
                                        <th>File</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    @foreach ($surat as $data)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $data->kode_surat }}</td>
                                            <td>{{ $data->tgl_terima_surat }}</td>
                                            <td>{{ $data->tgl_masuk_surat }}</td>
                                            <td>{{ $data->nomor_surat }}</td>
                                            <td>{{ $data->tujuan_surat }}</td>
                                            <td>{{ $data->perihal_surat }}</td>
                                            <td>{{ $data->file }}</td>
                                            <td>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <button type="button" class="btn btn-default dropdown-toggle"
                                                            data-toggle="dropdown">
                                                            Action
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="#"><i class="fa fa-trash"
                                                                    aria-hidden="true"></i> Delete</a>
                                                            <a class="dropdown-item" href="#"><i
                                                                    class="fas fa-edit"></i> Edit</a>
                                                            <a class="dropdown-item" href="#"><i class="fa fa-download"
                                                                    aria-hidden="true"></i> Download</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
@endsection

@section('script')

    <link rel="stylesheet" href="{{ asset('template/') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('template/') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('template/') }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

    <!-- DataTables  & Plugins -->
    <script src="{{ asset('template/') }}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('template/') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('template/') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('template/') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="{{ asset('template/') }}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('template/') }}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="{{ asset('template/') }}/plugins/jszip/jszip.min.js"></script>
    <script src="{{ asset('template/') }}/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="{{ asset('template/') }}/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="{{ asset('template/') }}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ asset('template/') }}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="{{ asset('template/') }}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('template/') }}/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('template/') }}/dist/js/demo.js"></script>
    <!-- Page specific script -->
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>

@endsection
