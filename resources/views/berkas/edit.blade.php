@extends('layout.template')

@section('content-title', 'Edit Data ' . $page['berkas']['jenis_surat'])

@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit Data <b> {{ $page['berkas']['sub_jenis_surat'] }} </b> </h3>
                        </div>
                        <form id="quickForm" method="POST"
                            action="{{ route('edit_berkas_data', ['id_data' => $berkas['id']]) }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Kode Surat</label>
                                    <input type="text" class="form-control" id="kode_surat"
                                        placeholder="Masukkan Kode Surat" value="{{ $berkas['kode_surat'] }}"
                                        name="kode_surat" value="{{ $berkas['kode_surat'] }}">
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Terima Surat</label>
                                    <div class="input-group date" id="reservationdate1" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input"
                                            data-target="#reservationdate1" value="{{ $berkas['tgl_terima_surat'] }}"
                                            name="tgl_terima_surat" />
                                        <div class="input-group-append" data-target="#reservationdate1"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Nomor Surat</label>
                                    <input type="text" class="form-control" value="{{ $berkas['nomor_surat'] }}"
                                        name="nomor_surat" id="nomor_surat" placeholder="Masukkan Nomor Surat">
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Surat Masuk</label>
                                    <div class="input-group date" id="reservationdate2" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input"
                                            data-target="#reservationdate2" value="{{ $berkas['tgl_masuk_surat'] }}"
                                            name="tgl_masuk_surat" />
                                        <div class="input-group-append" data-target="#reservationdate2"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                                @if ($berkas['jenis_surat'] == 2)
                                    <div class="form-group">
                                        <label>Tujuan Surat</label>
                                        <input type="text" class="form-control" value="{{ $berkas['tujuan_surat'] }}"
                                            name="tujuan_surat" id="tujuan_surat" placeholder="Masukkan Tujuan Surat">
                                    </div>
                                @else
                                    <div class="form-group">
                                        <label>Asal Surat</label>
                                        <input type="text" class="form-control" value="{{ $berkas['asal_surat'] }}"
                                            name="asal_surat" id="asal_surat" placeholder="Masukkan Asal Surat">
                                    </div>
                                @endif
                                <div class="form-group">
                                    <label>Perihal Surat</label>
                                    <input type="text" class="form-control" value="{{ $berkas['perihal_surat'] }}"
                                        name="perihal_surat" id="perihal_surat" placeholder="Masukkan Perihal Surat">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">File input</label><br>
                                    {{ $berkas['file'] }} <br />
                                    <input type="file" name="file">
                                </div>
                                <input type="hidden" name="jenis_surat" value={{ $berkas['jenis_surat'] }}>
                                <input type="hidden" name="sub_jenis_surat" value={{ $berkas['sub_jenis_surat'] }}>
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
                    perihal_surat: {
                        required: true,
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
                    perihal_surat: {
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
