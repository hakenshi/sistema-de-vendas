@extends('layouts.main')

@section('title', 'Home')

@section('content')
        <div class="main-container p-5">
            <div id="carouselId" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner" role="listbox">
                    <div class="carousel-item active">
                        <img
                            src="assets/wallpaperflare.com_wallpaper.jpg"
                            class="w-100 d-block"
                            alt="First slide"
                        />
                    </div>
                    <div class="carousel-item">
                        <img
                            src="assets/toyota-prius-publieditorial.jpg"
                            class="w-100 d-block"
                            alt="Second slide"
                        />
                    </div>
                    <div class="carousel-item">
                        <img
                            src="assets/Toyota-Prius_1.jpg"
                            class="w-100 d-block"
                            alt="Third slide"
                        />
                    </div>
                </div>
                <button
                    class="carousel-control-prev"
                    type="button"
                    data-bs-target="#carouselId"
                    data-bs-slide="prev"
                >
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button
                    class="carousel-control-next"
                    type="button"
                    data-bs-target="#carouselId"
                    data-bs-slide="next"
                >
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
                <div class="row">
                    <h3 class="m-5">Novos Lançamentos</h3>
                    <div class="col-md-10 offset-1">
                            <div class="card">
                                <div class="image-container"><img class="card-img-top" src="assets/laravel.svg" /></div>
                                <div class="card-body">
                                    <h4 class="card-title">Produto 1</h4>
                                    <p class="card-text">Produto 1</p>
                                    <div class="col-md-">
                                        <a href="#" class="btn btn-primary text-white">Ver produto</a>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
                {{-- <div class="row">
                    <div class="col md-10 offset-1 py-5">
                        <h3>Produtos mais vendidos</h3>
                        <div class="img-container">
                            <div class="card">
                                <img class="card-img-top" src="assets/laravel.svg" />
                                <div class="card-body">
                                    <h4 class="card-title">Produto 1</h4>
                                    <p class="card-text">Produto 1</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
@endsection