@extends('layout.template')

@section('content-title', 'Registrasi User')

@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Registrasi Data <b> User </b> </h3>
                        </div>
                        <form id="quickForm" method="POST" action="{{ route('registration_data') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="row">
                                            <label for="exampleInputFile" class="ml-4">Upload Foto</label><br>
                                            <div class="col-md-1"></div>
                                            <div class="col-md-10">
                                                <div class="text-center">

                                                    <div class="form-group">
                                                        @error('foto')
                                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-10 mb-4 text-center">
                                                <img id="preview-image" class="border p-4"
                                                    src="{{ asset('template/') }}/dist/img/user.png" alt="preview image"
                                                    style="max-height: 250px;" value="{{ old('foto') }}">
                                            </div>
                                            <input type="file" name="foto" placeholder="Choose image" id="image"
                                                class="@error('foto') is-invalid @enderror">
                                            <div class="col-md-1"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                id="nama" placeholder="Masukkan Nama" name="name" required
                                                value="{{ old('name') }}">
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                required value="{{ old('email') }}" name="email" id="email"
                                                placeholder="Masukkan Email">
                                            @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Password</label>
                                            <div class="input-group">
                                                <input type="password" id="password-field"
                                                    class="form-control @error('password') is-invalid @enderror" required
                                                    value="{{ old('password') }}" name="password"
                                                    placeholder="Masukkan Password">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span toggle="#password-field"
                                                            class="fa fa-fw fa-eye field-icon toggle-password-icon"></span>
                                                    </div>
                                                </div>
                                                @error('password')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Nomer HP</label>
                                            <input type="text" class="form-control @error('no_hp') is-invalid @enderror"
                                                required value="{{ old('no_hp') }}" name="no_hp" id="no_hp"
                                                placeholder="Masukkan Nomer HP">
                                            @error('no_hp')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Jabatan</label>
                                            <input type="text"
                                                class="form-control @error('jabatan') is-invalid @enderror" required
                                                value="{{ old('jabatan') }}" name="jabatan" id="jabatan"
                                                placeholder="Masukkan Jabatan">
                                            @error('jabatan')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <input type="hidden" name="status" value=1>
                                        <input type="hidden" name="role" value=1>
                                        <div class="form-group">
                                            <label>Alamat</label>
                                            <input type="text" class="form-control @error('alamat') is-invalid @enderror"
                                                required value="{{ old('alamat') }}" name="alamat" id="alamat"
                                                placeholder="Masukkan Alamat">
                                            @error('alamat')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>NPWP</label>
                                            <input type="text" class="form-control @error('npwp') is-invalid @enderror"
                                                required value="{{ old('npwp') }}" name="npwp" id="npwp"
                                                placeholder="Masukkan NPWP">
                                            @error('npwp')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                    </div>
                </div>
                </form>
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

    <script>
        $(".toggle-password-icon").click(function() {
            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
    </script>
@endsection
