@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="titulo-catgoria text-uppercase mt-5 mb-4">
            Categoria : {{ $categoriareceta->nombre }}    
        </h2>
        <div class="row">
            @foreach($categorias_receta as $receta)
                @include('ui.receta')
            @endforeach
        </div>
        <div class="d-flex justify-content-center mt-5">
            {{ $categorias_receta->links() }}
        </div>
    </div>    

@endsection