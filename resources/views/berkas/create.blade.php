@extends('layout.template')

@section('content-title', 'Tambah Data')

@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Tambah Data <b> {{ $page['jenis'] }} - {{ $page['sub_jenis'] }}
                                </b> </h3>
                        </div>
                        <form id="quickForm" method="POST" action="{{ route('create_berkas_data') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Kode Surat</label>
                                    <input type="text" class="form-control" id="kode_surat"
                                        placeholder="Masukkan Kode Surat" name="kode_surat">
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Terima Surat</label>
                                    <div class="input-group date" id="reservationdate1" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input" id="tgl_terima_surat"
                                            data-target="#reservationdate1" name="tgl_terima_surat" />
                                        <div class="input-group-append" data-target="#reservationdate1"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Nomor Surat</label>
                                    <input type="text" class="form-control" name="nomor_surat" id="nomor_surat"
                                        placeholder="Masukkan Nomor Surat">
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Surat Masuk</label>
                                    <div class="input-group date" id="reservationdate2" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input" id='tgl_masuk surat'
                                            data-target="#reservationdate2" name="tgl_masuk_surat" />
                                        <div class="input-group-append" data-target="#reservationdate2"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                                @if ($page['id_jenis'] == 2)
                                    <div class="form-group">
                                        <label>Tujuan Surat</label>
                                        <input type="text" class="form-control" name="tujuan_surat" id="tujuan_surat"
                                            placeholder="Masukkan Tujuan Surat">
                                    </div>
                                @else
                                    <div class="form-group">
                                        <label>Asal Surat</label>
                                        <input type="text" class="form-control" name="asal_surat" id="asal_surat"
                                            placeholder="Masukkan Asal Surat">
                                    </div>
                                @endif
                                <div class="form-group">
                                    <label>Perihal Surat</label>
                                    <input type="text" class="form-control" name="perihal_surat" id="perihal_surat"
                                        placeholder="Masukkan Perihal Surat">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">File input</label><br>
                                    <input type="file" name="file" id="file">
                                </div>
                            </div>
                            <input type="hidden" name="jenis_surat" value={{ $page['id_jenis'] }}>
                            <input type="hidden" name="sub_jenis_surat" value={{ $page['id_sub_jenis'] }}>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
        <div class="col-md-3"></div>
        <!-- /.col -->
        </div>
        <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>

@endsection

@section('script')

    <script src="{{ asset('template/') }}/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="{{ asset('template/') }}/plugins/jquery-validation/additional-methods.min.js"></script>
    <script>
        //Date picker
        $('#reservationdate1').datetimepicker({
            format: 'L'
        });
        $('#reservationdate2').datetimepicker({
            format: 'L'
        });
    </script>
    <script>
        $(function() {
            $('#quickForm').validate({
                rules: {
                    kode_surat: {
                        required: true,
                    },
                    nomor_surat: {
                        required: true,
                    },
                    asal_surat: {
                        required: true,
                    },
                    tujuan_surat: {
                        required: true,
                    },
                    perihal_surat: {
                        required: true,
                    },
                    tgl_masuk_surat: {
                        required: true
                    },
                    tgl_terima_surat: {
                        required: true
                    },
                    file: {
                        required: true
                    },
                },
                messages: {
                    kode_surat: {
                        required: "Wajib diisi !",
                    },
                    nomor_surat: {
                        required: "Wajib diisi !",
                    },
                    asal_surat: {
                        required: "Wajib diisi !",
                    },
                    tujuan_surat: {
                        required: "Wajib diisi !",
                    },
                    perihal_surat: {
                        required: "Wajib diisi !",
                    },
                    tgl_masuk_surat: {
                        required: "Wajib diisi !",
                    },
                    tgl_terima_surat: {
                        required: "Wajib diisi !",
                    },
                    file: {
                        required: "Wajib diisi !",
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
@endsection
