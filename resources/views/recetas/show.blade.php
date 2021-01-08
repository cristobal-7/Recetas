@extends ('layouts.app')

@section('content')

 {{-- {{$mostrar_receta}}  --}}
<article class="contenido-receta">

    <h1 class="text-center mb-4">{{$mostrar_receta->titulo}}</h1>

    <div class="imagen-receta">
        <img src="/storage/{{ $mostrar_receta->imagen }}" class="w-100">
    </div>

    <div class="receta-meta">
        <p>
            <span class="font-weight-bold text-primary">Escrito en: </span>
            {{$mostrar_receta->categoria->nombre}}
        </p>

        <p>
            <span class="font-weight-bold text-primary">Autor: </span>
            {{$mostrar_receta->user_id}}
        </p>

        <p>
            <span class="font-weight-bold text-primary">Fecha: </span>
            {{$mostrar_receta->created_at}}
        </p>

        <div class="ingredientes">
            <h2 class="my-3 text-primary">Ingredientes</h2>
            {{-- {!$datos->conHTMLdesdeLaDB -- podemos imprimir el codigo HTML desde la db con esta  sintaxis {! $dato_con_html !} !} --}}
            {!! $mostrar_receta->ingredientes !!}

            <fecha-receta></fecha-receta>
        </div>

        <div class="preparacion">
            <h2 class="my-3 text-primary">preparación</h2>
            {{-- {!$datos->conHTMLdesdeLaDB -- podemos imprimir el codigo HTML desde la db con esta  sintaxis {! $dato_con_html !} !} --}}
            {!! $mostrar_receta->preparacion !!}
        </div>

    </div>

</article>

@endsection

