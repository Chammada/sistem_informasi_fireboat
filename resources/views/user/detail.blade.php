@extends('layout.template')

@section('content-title', 'Detail User')

@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="card card-primary">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="row">
                                        <span class="ml-4 mt-4 text-muted">Foto</span><br>
                                        <div class="col-md-1"></div>
                                        <div class="col-md-10 mb-4 text-center">
                                            <img id="preview-image" class="border p-4"
                                                src="{{ asset('data_file/foto_user/') }}/{{ $user['foto'] }}"
                                                alt="preview image" style="max-height: 250px;">
                                        </div><br>
                                        <div class="row">
                                            <div class="col-md-12 ml-4">
                                                <div class="text-center">
                                                    <span class="text-center">{{ $user['foto'] }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-1"></div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="mb-2 mt-4">
                                        <span class="text-muted">Nama</span><br>
                                        <span class="h2 text-bold">{{ $user['name'] }}</span>
                                    </div><br>
                                    <div class="mb-2">
                                        <span class="text-muted">Email</span><br>
                                        <span class="h2">{{ $user['email'] }}</span>
                                    </div><br>
                                    <div class="mb-2">
                                        <span class="text-muted">Nomer HP</span><br>
                                        <span class="h2">{{ $user['no_hp'] }}</span>
                                    </div><br>
                                    <div class="mb-2">
                                        <span class="text-muted">Jabatan</span><br>
                                        <span class="h2">{{ $user['jabatan'] }}</span>
                                    </div><br>
                                    <div class="mb-2">
                                        <span class="text-muted">Status</span><br>
                                        @if ($user['status'] == 0)
                                            <div class="col-md-4 alert alert-danger alert-dismissible">
                                                Tidak Aktif
                                            </div>
                                        @elseif ($user['status'] == 1)
                                            <div class="col-md-4 alert alert-success alert-dismissible">
                                                Aktif
                                            </div>
                                        @endif
                                    </div><br>
                                    <div class="mb-2">
                                        <span class="text-muted">Alamat</span><br>
                                        <span class="h2">{{ $user['alamat'] }}</span>
                                    </div><br>
                                    <div class="mb-2">
                                        <span class="text-muted">NPWP</span><br>
                                        <span class="h2">{{ $user['npwp'] }}</span>
                                    </div><br>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <a class="btn btn-primary" href="{{ url()->previous() }}">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-1"></div>
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

    <script type="text/javascript">
        $('#image').change(function() {

            let reader = new FileReader();
            reader.onload = (e) => {
                $('#preview-image').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);

        });
    </script>
@endsection
