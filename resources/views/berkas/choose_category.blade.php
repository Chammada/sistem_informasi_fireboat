@extends('layout.template')

@section('content-title', $title)

@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <span class="font-weight-bold"> {{ $subtitle1 }} </span><br />
                                {{ $subtitle2 }}
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-3">
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group-prepend mb-2">
                                            <button type="button" class="btn btn-light btn-block dropdown-toggle"
                                                data-toggle="dropdown">
                                                <span class="text-left h5">Surat Masuk</span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li class="dropdown-item"><a
                                                        href="{{ route('read_data_berkas', ['id_data' => '1']) }}">Invoice</a>
                                                </li>
                                                <li class="dropdown-item"><a
                                                        href="{{ route('read_data_berkas', ['id_data' => '2']) }}">Faktur
                                                        Pajak</a></li>
                                                <li class="dropdown-item"><a
                                                        href="{{ route('read_data_berkas', ['id_data' => '3']) }}">Surat
                                                        Perintah Kerja</a></li>
                                                <li class="dropdown-item"><a
                                                        href="{{ route('read_data_berkas', ['id_data' => '4']) }}">Rekening
                                                        Koran Bank</a></li>
                                                <li class="dropdown-item"><a
                                                        href="{{ route('read_data_berkas', ['id_data' => '5']) }}">Surat
                                                        PO</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="input-group-prepend mb-2">
                                            <button type="button" class="btn btn-light btn-block dropdown-toggle"
                                                data-toggle="dropdown">
                                                <span class="text-left h5">Surat Keluar</span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li class="dropdown-item"><a
                                                        href="{{ route('read_data_berkas', ['id_data' => '6']) }}">Invoice</a>
                                                </li>
                                                <li class="dropdown-item"><a
                                                        href="{{ route('read_data_berkas', ['id_data' => '7']) }}">Surat
                                                        Jalan</a></li>
                                                <li class="dropdown-item"><a
                                                        href="{{ route('read_data_berkas', ['id_data' => '8']) }}">Surat
                                                        Pernyataan</a></li>
                                                <li class="dropdown-item"><a
                                                        href="{{ route('read_data_berkas', ['id_data' => '9']) }}">Surat
                                                        Permohonan</a></li>
                                                <li class="dropdown-item"><a
                                                        href="{{ route('read_data_berkas', ['id_data' => '10']) }}">Surat
                                                        PO</a></li>
                                            </ul>
                                        </div>
                                        <div class="input-group-prepend mb-2">
                                            <button type="button" class="btn btn-light btn-block dropdown-toggle"
                                                data-toggle="dropdown">
                                                <span class="text-left h5">Berkas Mahasiswa / Siswa Magang</span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li class="dropdown-item"><a
                                                        href="{{ route('read_data_berkas', ['id_data' => '11']) }}">SMA</a>
                                                </li>
                                                <li class="dropdown-item"><a
                                                        href="{{ route('read_data_berkas', ['id_data' => '12']) }}">SMK</a>
                                                </li>
                                                <li class="dropdown-item"><a
                                                        href="{{ route('read_data_berkas', ['id_data' => '13']) }}">Mahasiswa</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="input-group-prepend mb-2">
                                            <button type="button" class="btn btn-light btn-block dropdown-toggle"
                                                data-toggle="dropdown">
                                                <span class="text-left h5">Berkas Perusahaan</span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li class="dropdown-item"><a
                                                        href="{{ route('read_data_berkas', ['id_data' => '14']) }}">Berkas
                                                        Pajak Import</a></li>
                                                <li class="dropdown-item"><a
                                                        href="{{ route('read_data_berkas', ['id_data' => '15']) }}">SPT
                                                        Tahunan</a>
                                                </li>
                                                <li class="dropdown-item"><a
                                                        href="{{ route('read_data_berkas', ['id_data' => '16']) }}">SPT
                                                        PPN</a></li>
                                                <li class="dropdown-item"><a
                                                        href="{{ route('read_data_berkas', ['id_data' => '17']) }}">PPH
                                                        21</a></li>
                                                <li class="dropdown-item"><a
                                                        href="{{ route('read_data_berkas', ['id_data' => '18']) }}">PPH
                                                        23 Bukti Potong</a></li>
                                            </ul>
                                        </div>
                                        <div class="input-group-prepend mb-2">
                                            <button type="button" class="btn btn-light btn-block dropdown-toggle"
                                                data-toggle="dropdown">
                                                <span class="text-left h5">Berkas Tender</span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li class="dropdown-item"><a
                                                        href="{{ route('read_data_berkas', ['id_data' => '19']) }}">Surat
                                                        Dukungan</a></li>
                                                <li class="dropdown-item"><a
                                                        href="{{ route('read_data_berkas', ['id_data' => '20']) }}">Surat
                                                        Pernyataan</a>
                                                </li>
                                                <li class="dropdown-item"><a
                                                        href="{{ route('read_data_berkas', ['id_data' => '21']) }}">Surat
                                                        Fiskal</a>
                                                </li>
                                                <li class="dropdown-item"><a
                                                        href="{{ route('read_data_berkas', ['id_data' => '22']) }}">Pengalaman
                                                        Proyek</a></li>
                                                <li class="dropdown-item"><a
                                                        href="{{ route('read_data_berkas', ['id_data' => '23']) }}">Data
                                                        Perusahaan</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                    </div>
                                </div>
                            </div>
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
