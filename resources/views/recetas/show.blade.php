

@extends ('layouts.app')
@section('botones')

<a href="{{ route('recetas.index') }}" class="btn btn-primary mr-2 text-while">volver</a>
<a href="{{ route('recetas.edit', ['receta' => $mostrar_receta->id]) }}" class="btn btn-primary mr-2 text-while">Editar</a>

@endsection
@section('content')

 {{-- {{$mostrar_receta}}  --}}
<article class="contenido-receta bg-white p-5 shadow">

    <h1 class="text-center mb-4">{{$mostrar_receta->titulo}}</h1>

    <div class="imagen-receta">
        <img src="/storage/{{ $mostrar_receta->imagen }}" class="w-100">
    </div>

    <div class="receta-meta mt-4">
        <p>
            <span class="font-weight-bold text-primary">Escrito en: </span>
            <a class="text-dark" href="{{ Route('categorias.show', ['categoriaReceta' => $mostrar_receta->categoria->id ]) }}" >
                {{$mostrar_receta->categoria->nombre}}
            </a>
            
        </p>

        <p>
            <span class="font-weight-bold text-primary">Autor: </span>
            <a class="text-dark" href="{{ Route('perfiles.show', ['perfil' => $mostrar_receta->autor->id ]) }}" >
                {{$mostrar_receta->autor->name}}
            </a>
            
        </p>

        <p>
            <span class="font-weight-bold text-primary">Fecha: </span>
       
          {{Carbon\Carbon::parse($mostrar_receta->created_at)->formatLocalized('%A %e de %B de %Y')}}
            
        </p>
        

        <div class="ingredientes">
            <h2 class="my-3 text-primary">Ingredientes</h2>
            {{-- {!$datos->conHTMLdesdeLaDB -- podemos imprimir el codigo HTML desde la db con esta  sintaxis {! $dato_con_html !} !} --}}
            {!! $mostrar_receta->ingredientes !!}

            
        </div>

        <div class="preparacion">
            <h2 class="my-3 text-primary">preparación</h2>
            {{-- {!$datos->conHTMLdesdeLaDB -- podemos imprimir el codigo HTML desde la db con esta  sintaxis {! $dato_con_html !} !} --}}
            {!! $mostrar_receta->preparacion !!}
        </div>
    </div>

    
    <div class="justify-content-center row text-center">
            <like-button
                receta-id="{{$mostrar_receta->id}}"
                like="{{$like}}"
                likes="{{$contar_likes}}"
            ></like-button>
    </div>
   
</article>

@endsection

