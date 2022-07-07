        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-light-primary elevation-2">
            <!-- Brand Logo -->
            <a href="{{ route('dashboard') }}" class="brand-link">
                <img src="{{ asset('template/') }}/dist/img/LogoFBI.png" alt="FiberBoat Indonesia"
                    class="brand-image img-circle" style="opacity: .8">
                <span class="brand-text font-weight-dark">FiberBoat Indonesia</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('data_file/foto_user/') }}/{{ auth()->user()->foto }}" class="img-square elevation-2"
                            alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">Hi, Hamada</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a active data-sub_jenis='1' data-title="Data Berkas" href="" data-toggle="modal"
                                data-target="#modal-default"
                                class="nav-link open-modal {{ $data_url[1] === 'read_berkas' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Data Berkas
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a data-sub_jenis='2' data-title="Tambah Data" href="" data-toggle="modal"
                                data-target="#modal-default"
                                class="nav-link open-modal {{ $data_url[1] === 'create_berkas' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-plus"></i>
                                <p>
                                    Tambah Data
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a data-sub_jenis='3' data-title="Berkas Disetujui" href="" data-toggle="modal"
                                data-target="#modal-default"
                                class="nav-link open-modal {{ $data_url[1] === 'approved_berkas' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-check"></i>
                                <p>
                                    Berkas Disetujui
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a data-sub_jenis='4' data-title="Berkas Tidak Disetujui" href="" data-toggle="modal"
                                data-target="#modal-default"
                                class="nav-link open-modal {{ $data_url[1] === 'unapproved_berkas' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-times"></i>
                                <p>
                                    Berkas Tidak Disetujui
                                </p>
                            </a>
                        </li>
                        @if (auth()->user()->role == 3)
                            <li class="nav-item">
                                <a href="{{ route('read_user') }}"
                                    class="nav-link {{ $data_url[0] === 'user' ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>
                                        Manage User
                                    </p>
                                </a>
                            </li>
                        @endif
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <div class="modal fade" id="modal-default">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <label for="" class="title"></label>
                        <h4 class="modal-title title"><input style="border: 0px;" class="title" readonly />
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-12">
                            @foreach ($data_jenis as $jenis)
                                <div class="input-group-prepend mb-2">
                                    <button type="button" class="btn btn-light btn-block dropdown-toggle"
                                        data-toggle="dropdown">
                                        <span class="text-left h5">{{ $jenis->nama }}</span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        @foreach ($data_sub_jenis as $sub_jenis)
                                            @if ($jenis->id == $sub_jenis->jenis_surat)
                                                <li class="dropdown-item">
                                                    <form action="{{ route('choose_category') }}">
                                                        <input type="hidden" name="id_sub_jenis"
                                                            value={{ $sub_jenis->id }}>
                                                        <input type="hidden" name="sub_jenis_modal"
                                                            class="sub_jenis_modal" value="">
                                                        <button type="submit"
                                                            class="dropdown-item btn btn-light">{{ $sub_jenis->nama }}</button>
                                                    </form>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
