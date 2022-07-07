@extends('layout.template')

@section('content-title', 'Dashboard')

@section('content')

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img class="d-block w-100" src="{{ asset('data_file/') }}/dashboard/kantor.jpg"
                                        alt="First slide">

                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>FiberBoat Indonesia</h5>
                                        <p>Ruang Meeting</p>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block w-100" src="{{ asset('data_file/') }}/dashboard/gudang_1.jpg"
                                        alt="Second slide">

                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>FiberBoat Indonesia</h5>
                                        <p>Area Workshop</p>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block w-100" src="{{ asset('data_file/') }}/dashboard/gudang_2.jpg"
                                        alt="Third slide">

                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>FiberBoat Indonesia</h5>
                                        <p>Area Workshop</p>
                                    </div>
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleControls" role="button"
                                data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleControls" role="button"
                                data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
