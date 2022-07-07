@extends('layout.template')

@section('content-title', 'Data ' . $page['title'])

@section('content')

<div class="row">
  <div class="col-md-2 m-3">
    <a href="{{ route('create_berkas_page', ['id_jenis' => $page['id_jenis'], 'id_sub_jenis' => $page['id_sub_jenis']]) }}" class="btn btn-success">+ Tambah Data</a>
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
                  <th>Kode Surat</th>
                  <th>Tgl Terima Surat</th>
                  <th>Tgl Masuk Surat</th>
                  <th>Nomor Surat</th>
                  <th>Tujuan Surat</th>
                  <th>Perihal Surat</th>
                  <th>File</th>
                  <th>Status</th>
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
                    @if ($data->status == 0)
                    <div class="alert alert-info alert-dismissible">
                      Belum Validasi
                    </div>
                    @elseif ($data->status == 1)
                    <div class="alert alert-success alert-dismissible">
                      Diterima
                    </div>
                    @elseif ($data->status == 2)
                    <div class="alert alert-danger alert-dismissible">
                      Tidak Diterima
                    </div>
                    @endif
                  </td>
                  <td>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                          Action
                        </button>
                        <div class="dropdown-menu">
                          <form action="{{ route('delete_data_berkas', ['id_data' => $data->id, 'id_sub_jenis' => $page['id_sub_jenis']] ) }}" method="POST">
                            @csrf
                            <button class="dropdown-item confirm-delete"><i class="fa fa-trash" aria-hidden="true"></i>
                              Delete</button>
                          </form>
                          <a class="dropdown-item" href="{{ route('edit_berkas_page', ['id_data' => $data->id]) }}"><i class="fas fa-edit"></i> Edit</a>
                          <a class="dropdown-item" href="{{ route('download_file', ['id_data' => $data->id]) }}"><i class="fa fa-download" aria-hidden="true"></i>
                            Download</a>
                          <a class="dropdown-item" href="{{ route('detail_data_berkas', ['id_data' => $data->id]) }}"><i class="fas fa-eye"></i> Detail</a>
                          <a class="dropdown-item" href="{{ route('view_file', ['id_data' => $data->id]) }}"><i class="fas fa-eye"></i> View PDF</a>
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
    var form = $(this).closest("form");
    var name = $(this).data("name");
    event.preventDefault();
    Swal.fire({
      title: `Apakah Anda yakin menghapus berkas ini ?`,
      text: "Data akan terhapus",
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