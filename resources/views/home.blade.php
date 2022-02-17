@extends('layout')

@section('content')
    @if (session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <h1>Bienvenue dans l'application de recettes de cuisine</h1>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corrupti exercitationem nisi aliquam iure voluptas
        incidunt delectus eos ullam accusantium. Vero blanditiis totam, reiciendis illo numquam a amet animi explicabo
        facilis aut! Minima culpa nostrum aliquid velit autem cupiditate, rem architecto incidunt consequuntur excepturi
        quam reprehenderit quasi, quae corrupti omnis eos?</p>

    <h2>Les dernières recettes ajoutées : </h2>

    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            @php
                $i = 1;
            @endphp
            @foreach ($recipes as $recipe)
                <div class="img-slider carousel-item {{ $i == '1' ? 'active' : '' }}">
                    @php
                        $i++;
                    @endphp
                    <img src={{ $recipe->filePictureRecipe }} class="d-block w-100" alt="slider-image">
                    <div class="carousel-caption d-none d-md-block">
                        <h3>{{ $recipe->nameRecipe }}</h3>
                        <a class="btn btn-primary" href="/recipe-list/{{ $recipe->id }}" type="button"
                            class="btn btn-primary">Voir la recette</a>
                    </div>
                </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
@endsection
