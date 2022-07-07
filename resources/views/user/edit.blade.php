@extends('layout.template')

@section('content-title', 'Edit User')

@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit Data <b> User </b> </h3>
                        </div>
                        <form id="quickForm" method="POST" action="{{ route('edit_user_data') }}"
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
                                                value="{{ $user['foto'] }}">
                                            <div class="col-md-1"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                id="nama" placeholder="Masukkan Nama" name="name" required
                                                value="{{ $user['name'] }}">
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                required value="{{ $user['email'] }}" name="email" id="email"
                                                placeholder="Masukkan Email">
                                            @error('email')
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
                                            <label>Role</label>
                                            <select class="form-select" aria-label="Default select example" name="role">
                                                <option {{ $user['role'] === 1 ? 'selected' : '' }} value="1">
                                                    Pegawai</option>
                                                <option {{ $user['role'] === 2 ? 'selected' : '' }} value="2">
                                                    Manager / Admin</option>
                                            </select>
                                            @error('jabatan')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Jabatan</label>
                                            <input type="text"
                                                class="form-control @error('jabatan') is-invalid @enderror" required
                                                value="{{ $user['jabatan'] }}" name="jabatan" id="jabatan"
                                                placeholder="Masukkan Jabatan">
                                            @error('jabatan')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Alamat</label>
                                            <input type="text" class="form-control @error('alamat') is-invalid @enderror"
                                                required value="{{ $user['alamat'] }}" name="alamat" id="alamat"
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
                                                required value="{{ $user['npwp'] }}" name="npwp" id="npwp"
                                                placeholder="Masukkan NPWP">
                                            @error('npwp')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <input type="hidden" name="id" value="{{ $user['id'] }}">
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

@endsection
