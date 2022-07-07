@extends('layout.template')

@section('content-title', 'Edit Profile')

@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit Data <b> Profile </b> </h3>
                        </div>
                        <form id="quickForm" method="POST" action="{{ route('setup_profile_data') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="row">
                                            <label for="exampleInputFile" class="ml-4">Ganti Foto</label><br>
                                            <div class="col-md-1"></div>
                                            <div class="col-md-10">
                                                <div class="text-center">

                                                    <div class="form-group">
                                                        @error('name')
                                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-10 mb-4 text-center">
                                                <img id="preview-image" class="border p-4"
                                                    src="{{ asset('data_file/foto_user/') }}/{{ $user['foto'] }}"
                                                    alt="preview image" style="max-height: 250px;">
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="text-center">
                                                        {{ $user['foto'] }}
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="file" name="foto" placeholder="Choose image" id="image"
                                                value="">
                                            <div class="col-md-1"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                id="nama" placeholder="Masukkan Nama" name="name" required
                                                value="{{ $user->name }}">
                                            @if ($errors->any())
                                                <div class="alert alert-danger">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                    @if ($errors->has('error'))
                                                        <div>halo</div>
                                                    @endif
                                                </div>
                                            @endif
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                required value="{{ $user->email }}" name="email" id="email"
                                                placeholder="Masukkan Email">
                                            @error('error')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Nomer HP</label>
                                            <input type="text" class="form-control @error('no_hp') is-invalid @enderror"
                                                required value="{{ $user['no_hp'] }}" name="no_hp" id="no_hp"
                                                placeholder="Masukkan Nomer HP">
                                            @error('no_hp')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Alamat</label>
                                            <input type="text" class="form-control @error('alamat') is-invalid @enderror"
                                                required value="{{ $user->alamat }}" name="alamat" id="alamat"
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
                                                required value="{{ $user->npwp }}" name="npwp" id="npwp"
                                                placeholder="Masukkan NPWP">
                                            @error('npwp')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <input type="hidden" name="id" value="{{ $user->id }}">
                                    </div>
                                    <div class="col-md-4">
                                        <div class="ml-4">
                                            <span class="h5">Change Password</span><br>
                                            <small class="text-muted">Hanya untuk mengganti password</small>
                                            <div class="form-group mt-3">
                                                <label>Password Lama</label>
                                                <div class="input-group">
                                                    <input type="password" class="form-control" name="current_password"
                                                        id="password_current-field" placeholder="Masukkan Password Lama">

                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span toggle="#password_current-field"
                                                                class="fa fa-fw fa-eye field-icon toggle-password-icon"></span>
                                                        </div>
                                                    </div>
                                                    @error('current_password')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Password Baru</label>
                                                <div class="input-group">
                                                    <input type="password" class="form-control" name="new_password"
                                                        id="password_new-field" placeholder="Masukkan Password Baru">
                                                    @error('new_password')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span toggle="#password_new-field"
                                                                class="fa fa-fw fa-eye field-icon toggle-password-icon"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Konfirmasi Password Baru</label>
                                                <div class="input-group">
                                                    <input type="password" class="form-control"
                                                        name="new_confirm_password" id="password_confirm-field"
                                                        placeholder="Masukkan Konfirmasi Password Baru">
                                                    @error('confirm_password')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span toggle="#password_confirm-field"
                                                                class="fa fa-fw fa-eye field-icon toggle-password-icon"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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

    <script src="{{ asset('template/') }}/dist/js/adminlte.min.js"></script>
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
