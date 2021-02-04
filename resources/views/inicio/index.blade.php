@extends('layouts.app')

@section('styles')

{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" /> --}}
    
@endsection

@section('hero')

<div class="hero-categorias">
    <form class="container h-100" action={{ Route('buscar.show') }}>
        <div class="row h-100 align-items-center">
            <div class="col-md4 texto-buscar">
                <p class="display-4">Encuentra una receta para tu proxima comida</p>
            <input
            type="search"
            name="buscar"
            class="form-control"
            placeholder="Buscar Receta"
            />
            </div>
        </div>
    </form>
</div>


@endsection

@section('content')

{{-- <img src="{{ asset('/images/bgimagen.jpg') }}" alt="imagen de fondo"> --}}

    <div class="container nuevas-recetas">
        <h2 class="titulo-categoria text-uppercase mt-5 mb-4">Últimas Recetas</h2>

        <div class="row">
            @foreach($recetas_nuevas as $recetas_nueva)
            <div class="col-md-4"> 
                <div class="card">
                    <img src="/storage/{{ $recetas_nueva->imagen }}" class="card-img-top" alt="imagen receta">
                    <div class="card-body">
                        <h3>{{ Str::title($recetas_nueva->titulo)}}</h3> 

                        {!! Str::words(  strip_tags($recetas_nueva->preparacion) , 15) !!}
                        
                         {{-- la función strip_tags() elimina las etiquetas html --}}
                        {{-- <p> {!!  $recetas_nueva->preparacion  !!} </p> --}}

                        <a href="{{ route('recetas.show', ['receta' => $recetas_nueva->id ]) }}" 
                        class="btn btn-primary d-block font-weight-bold text-uppercase" 
                        >Ver Receta</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="container">
        <h2 class="titulo-categoria text-uppercase mt-5 mb-4">Recetas más votadas </h2>
            <div class="row">
                    @foreach($votadas as $receta)
                        @include('ui.receta')
                    @endforeach
            </div>
    </div>

    @foreach($recetas_categoria as $key => $grupo)
    <div class="container">
        <h2 class="titulo-categoria text-uppercase mt-5 mb-4">{{ str_replace('-',' ', $key) }} </h2>
            <div class="row">
                @foreach($grupo as $recetas)
                    @foreach($recetas as $receta)
                        @include('ui.receta')
                    @endforeach
                @endforeach
            </div>
    </div>
        
    @endforeach

@endsection

