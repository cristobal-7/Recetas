
@extends('layouts.app') <!-- Hereda los estilos de app.bade.php -->

@section('botones')
    @include('ui.navegacion')
@endsection

@section('content')
<h2 class="text-center mb-5">Administra tus recetas </h2>
<div class="col-md-10 mx-auto bg-white p-3">
    <table class="table">
        <thead class="bg-primary text-light">
            <tr>
                <th scole="col">Titulo</th>
                <th scole="col">Categoria</th>
                <th scole="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($recetas as $receta)
                
            <tr id="receta">
                <td>{{$receta->titulo}}</td>
                <td>{{$receta->categoria->nombre}}</td>
                <td>

                    {{-- <a class="btn btn-danger d-block mb-2" onclick="deleteConfirmation({{$receta->id}})">Eliminar</a> --}}
                    
                     <a class="btn btn-danger d-block mb-2"
                       data-id="{{ $receta->id }}" data-action="{{ route('recetas.destroy', $receta->id) }}" 
                       onclick="deleteConfirmation({{$receta->id}})"
                    > Eliminar &times;</a>
                    
              
                    {{--// asi se eliminar de la forma tradicional - sin interaciones. 

                        <form action="{{ Route('recetas.destroy', ['receta' => $receta->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')//HTML no soporta el metodo('DELETE') entonces agregamos directiva de Laravel.
                        <input type="submit" name="" id="" class="btn btn-danger d-block w-100 mb-2" value="Eliminar &times;" >
                    </form> --}}

                  

                    <a href="{{ route('recetas.edit', ['receta' => $receta->id])}}" class="btn btn-dark d-block mb-2">Editar</a>
                    <a href="{{ route('recetas.show', ['receta' => $receta->id])}} " class="btn btn-success d-block mb-2">Ver</a>
                </td>
            </tr>
            @endforeach  
        </tbody>

    </table>

    <script type="text/javascript">
        function deleteConfirmation(id) {
            swal({
                title: "Eliminar",
                text: "si se elimina, no se podra recuperar",
                type: "warning",
                showCancelButton: !0,
                confirmButtonText: "Si",
                cancelButtonText: "No",
                reverseButtons: !0
                
            }).then(function (e) {
    
                if (e.value === true) {
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    
                    $.ajax({
                        type: 'post',
                        url: "{{url('/delete')}}/" + id,
                        data: {_token: CSRF_TOKEN},
                        dataType: 'JSON',
                        success: function (results) {
    
                            if (results.success === true) {
                            swal("Bien!", results.message, "success");
                            var tr = document.getElementById("receta");
                            tr.parentNode.removeChild(tr);
                        } else {
                            swal("Error!", results.message, "error");
                        }
                        }
                        
                    }); 
                        } else {
                            e.dismiss;
                        }
                    }, 
                            function (dismiss) {
                                return false;
                            })
        }
    </script>
   
        <div class="col-12 mt-4 justify-content-center d-flex">
            {{$recetas->links()}}
        </div>
    <h2 class="text-center my-5 ">Recetas que te gustan</h2>
        <div class="col-md-10 mx-auto bg-white p-3 ">
            <ul class="list-group">
            @if( count($usuario->meGusta) > 0)
                @foreach($usuario->meGusta as $receta)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <p> {{$receta->titulo}} </p>
                    <a class="btn btn-outline-success text-uppercase" href="{{ route('recetas.show', ['receta' => $receta->id]) }}">Ver </a>
                </li>
                    
                @endforeach
            </ul>
            @else
            <p class="text-center">Aún no tienes recetas guardadas 
                <small>Dale me gusta a las recetas y apracerán aquí</small>  
            </p>
            @endif
        </div>
        
</div>
@endsection