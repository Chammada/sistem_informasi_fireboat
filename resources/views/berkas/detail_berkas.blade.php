@extends('layout.template')

@section('content-title', 'Data ' . $page['title'])

@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            Data <b>{{ $page['berkas']['jenis_surat'] }} </b>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="text-center mt-4">
                                        <i class="fas fa-file fa-10x"></i><br>
                                        <div class="mt-4">
                                            <span class="h2">
                                                {{ $berkas['file'] }}
                                            </span>
                                        </div><br>
                                        <button class="btn btn-success">
                                            <i class="fa fa-download fa-fw" aria-hidden="true"></i> <a
                                                style="text-decoration: none; color: white"
                                                href="{{ route('download_file', ['id_data' => $berkas['id']]) }}">
                                                Downloads
                                            </a> </button>
                                        @if (auth()->user()->role == 3 || auth()->user()->role == 2)

                                            <form action="">
                                                <div class="form-group">
                                                    <div class="row ml-4 mt-4">
                                                        <label>Status</label>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                @if ($berkas['status'] == 0)
                                                                    <button type="button"
                                                                        class="btn btn-default dropdown-toggle"
                                                                        data-toggle="dropdown">
                                                                        Belum Validasi
                                                                    </button>
                                                                    <div class="dropdown-menu">
                                                                        <a class="dropdown-item"
                                                                            href="{{ route('validate_berkas', ['id_berkas' => $berkas['id'], 'status' => 1]) }}">ACC</a>
                                                                        <a class="dropdown-item"
                                                                            href="{{ route('validate_berkas', ['id_berkas' => $berkas['id'], 'status' => 2]) }}">Tolak</a>
                                                                    </div>
                                                                @elseif ($berkas['status'] == 1)
                                                                    <button type="button"
                                                                        class="btn btn-success dropdown-toggle"
                                                                        data-toggle="dropdown">
                                                                        Acc
                                                                    </button>
                                                                    <div class="dropdown-menu">
                                                                        <a class="dropdown-item"
                                                                            href="{{ route('validate_berkas', ['id_berkas' => $berkas['id'], 'status' => 2]) }}">Tolak</a>
                                                                    </div>
                                                                @else
                                                                    <button type="button"
                                                                        class="btn btn-danger dropdown-toggle"
                                                                        data-toggle="dropdown">
                                                                        Ditolak
                                                                    </button>
                                                                    <div class="dropdown-menu">
                                                                        <a class="dropdown-item"
                                                                            href="{{ route('validate_berkas', ['id_berkas' => $berkas['id'], 'status' => 1]) }}">Acc</a>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <table class="table table-hover table-striped">
                                        <tbody>
                                            <tr>
                                                <td><b> Kode Surat </b></td>
                                                <td>
                                                    {{ $berkas['kode_surat'] }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><b> Jenis Surat </b></td>
                                                <td>
                                                    {{ $berkas['jenis_surat'] }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><b> Sub Jenis Surat </b></td>
                                                <td>
                                                    {{ $berkas['sub_jenis_surat'] }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><b> Tanggal Terima Surat </b></td>
                                                <td>
                                                    {{ $berkas['tgl_terima_surat'] }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><b> Tanggal Masuk Surat </b></td>
                                                <td>
                                                    {{ $berkas['tgl_masuk_surat'] }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><b> Nomor Surat </b></td>
                                                <td>
                                                    {{ $berkas['nomor_surat'] }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><b> Asal Surat </b></td>
                                                <td>
                                                    {{ $berkas['asal_surat'] }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><b> Tujuan Surat </b></td>
                                                <td>
                                                    {{ $berkas['tujuan_surat'] }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><b> Perihal Surat </b></td>
                                                <td>
                                                    {{ $berkas['perihal_surat'] }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
