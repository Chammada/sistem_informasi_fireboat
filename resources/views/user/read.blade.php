@extends('layout.template')

@section('content-title', 'Data ' . $page['title'])

@section('content')

    <div class="row">
        <div class="col-md-2 m-3">
            <a href="{{ route('registration_page') }}" class="btn btn-success">+ Tambah Data</a>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            {{ $page['sub_title'] }}
                        </div>
                        <div class="card-body">

                            <table id="example1" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Nomer HP</th>
                                        <th>Alamat</th>
                                        <th>NPWP</th>
                                        <th>Jabatan</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    @foreach ($user as $data)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $data->name }}</td>
                                            <td>{{ $data->email }}</td>
                                            <td>{{ $data->no_hp }}</td>
                                            <td>{{ $data->alamat }}</td>
                                            <td>{{ $data->npwp }}</td>
                                            <td>{{ $data->jabatan }}</td>
                                            <td>
                                                @if ($data->status == 0)
                                                    <div class="alert alert-danger alert-dismissible">
                                                        Tidak Aktif
                                                    </div>
                                                @elseif ($data->status == 1)
                                                    <div class="alert alert-success alert-dismissible">
                                                        Aktif
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <button type="button" class="btn btn-default dropdown-toggle"
                                                            data-toggle="dropdown">
                                                            Action
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <form
                                                                action="{{ route('change_user_status', ['id_data' => $data->id]) }}"
                                                                method="POST">
                                                                @csrf
                                                                <button class="dropdown-item confirm-delete"><i
                                                                        class="fas fa-toggle-on"></i>
                                                                    Ubah Status</button>
                                                            </form>
                                                            <a class="dropdown-item"
                                                                href="{{ route('edit_user_page', ['id_data' => $data->id]) }}"><i
                                                                    class="fas fa-edit"></i> Edit</a>
                                                            <a class="dropdown-item"
                                                                href="{{ route('detail_user', ['id_data' => $data->id]) }}"><i
                                                                    class="fas fa-eye"></i> Detail</a>

                                                            <form
                                                                action="{{ route('reset_user_password', ['id_data' => $data->id]) }}"
                                                                method="POST">
                                                                @csrf
                                                                <button class="dropdown-item"><i
                                                                        class="fas fa-key"></i>
                                                                    Reset Password</button>
                                                            </form>
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
    <link rel="stylesheet"
        href="{{ asset('template/') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

    <script type="text/javascript">
        $('.confirm-delete').click(function(event) {
            console.log("halo");
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            Swal.fire({
                title: `Are you sure you want to delete this record?`,
                text: "If you delete this, it will be gone forever.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    form.submit();
                }
            });
        });
    </script>
@endsection
