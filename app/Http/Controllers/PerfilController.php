<?php

namespace App\Http\Controllers;

use App\Perfil;
use App\Receta;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{

    public function __construct()
    {
        //$this->middleware('auth');
        $this->middleware('auth',['except' => 'show']);
    }
   

    /**
     * Display the specified resource.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function show(Perfil $perfil)
    {
        //Obtener las recetas con paginación
        $recetas = Receta::where('user_id', $perfil->user_id)->paginate(6);
        //Se poda ver esta vista sin necesidad de estar autenticado - gracias a la excepción del middleware
        return view('perfiles.show')->with('mostrar_perfil', $perfil)
                                    ->with('recetas', $recetas);
                                    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function edit(Perfil $perfil)
    {
        //Revisar el policy - para que nadie pueda acceder al perfil de otro usuario 
        $this->authorize('view', $perfil);
        
        return view('perfiles.edit')->with('mostrar_perfil', $perfil);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Perfil $perfil)
    {
        //Ejecutar policy -> PerfilPolicy
        $this->authorize('update', $perfil);
        
        //Validar
        $data = request()->validate([
            'nombre' => 'required|max:30',
            'url' => 'required|url',
            'biografia' => 'required|max:1200'
        ]);
        //si el usuario sube una imagen
        //dd($data); -- dd($request['imagen']);

        if( $request['imagen'] ){
             //obtener la ruta de la imagen
        $ruta_imagen = $request['imagen']->store('upload-perfiles', 'public');

        // Resize de la imagen
        $img = Image::make( public_path("storage/{$ruta_imagen}"))->fit(600, 600);
        $img->save();//Guardar en Disco Duro.
        
        //Crear un arreglo de imagen
        $array_imagen = ['imagen' => $ruta_imagen];

        } 
            
        /**Se guardara información en 2 tablas - users y perfils */
        //Asignar nombre y url en Tabla => users
        auth()->user()->url = $data['url'];
        auth()->user()->name = $data['nombre'];
        auth()->user()->save();

        //Eliminar url y name de $data, para poder guardar datos en la segunda tabla.
        unset($data['url']);
        unset($data['nombre']); // modificación de la var originar debido que ya no es requerida en su totalidad.
       
        //Guardar información
        //Asignar biografia e imagen en Tabla => perfils
        auth()->user()->perfil()->update( array_merge( // array_marge = basicamente une multiples arreglos
            $data, 
            $array_imagen ?? []
        ) );
        
         
        //Redirecionar
        return redirect()->action('RecetaController@index');
    }

}
