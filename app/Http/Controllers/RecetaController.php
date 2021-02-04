<?php

namespace App\Http\Controllers;

use App\User;
use App\Receta;
use Carbon\Carbon;
use App\CategoriaReceta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Redirect;

class RecetaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show', 'search']]);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        /**esta sintaxys realiza la misma acción de Auth::user()->recetas->dd()
         * auth()->user()->recetas->dd()
         */
        // Auth::user()->recetas->dd()

        // $usuario = auth()->user();
        // $recetas = auth()->user()->recetas;

        $usuario = auth()->user();

        // $meGusta = auth()->user()->meGusta; -> esta seria una forma de pasar a la vista las recetas que le han dado like.
        //Recetas con páginación
        $recetas = Receta::where('user_id', $usuario->id)->paginate(6);

        return view('recetas.index')
            ->with('recetas', $recetas)
             ->with('usuario', $usuario);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Esta es la forma de obtener las categorias (sin modelos)
       // $categorias = DB::table('categoria_recetas')->get()->pluck('nombre', 'id');

        // obtener con Modelo
        $categorias = CategoriaReceta::all(['id', 'nombre']);

        return view('recetas.create')->with('categorias', $categorias);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * 
     * Este metodo es similar a var_dum() de PHP, nos imprime todo el contenido de la variable $request
     * dd($request->all());
     * 
     */
    public function store(Request $request)
    {//dd($request->all());

        //Validación
        $data = $request->validate([
            'titulo' => 'required|min:5|max:35' ,
            'preparacion' => 'required|min:15',
            'ingredientes' => 'required|min:3',
            'imagen' => 'required|image', // 2 MB
           'categoria' => 'required'
        ]);

        //obtener la ruta de la imagen
        $ruta_imagen = $request['imagen']->store('upload-recetas', 'public');

        // Resize de la imagen
        $img = Image::make( public_path("storage/{$ruta_imagen}"))->fit(1024, 512);
        $img->save();//Guardar en Disco Duro.

        //almacenar en la base de datos (sin modelo)
        // DB::table('recetas')->insert([
        //     'titulo' => $data['titulo'],
        //     'preparacion' => $data['preparacion'],
        //     'ingredientes' => $data['ingredientes'],
        //     'imagen' => $ruta_imagen,
        //     'user_id' => Auth::user()->id,
        //     'categoria_id' => $data['categoria']
        // ]);

        // Almacenar en la base de datos (con Modelo)
            auth()->user()->recetas()->create([
                'titulo' => $data['titulo'],
                'preparacion' => $data['preparacion'],
                'ingredientes' => $data['ingredientes'],
                'imagen' => $ruta_imagen,
                'categoria_id' => $data['categoria']
            ]);

        // Redireccionar
        return redirect()->action('RecetaController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     * 
     * algunos metodos para obtener datos con el id.  
     * show($id) { $id_dato = Receta::find($ids); return $id_datos; } //retorna el array con los datos 
     * // existe el metodo ::findOrFail($var)
     */
    public function show(Receta $receta)
    {   
        //Obtener si el usuario actual le gusta la receta y esta autenticado
            $like = ( auth()->user() ) ? auth()->user()->meGusta ->contains($receta->id) : false;

            //pasar la cantidad de likes a la vista
            $likes = $receta->likes->count();

            // return view('recetas.show', compact('mostrar_receta', 'like');
         return view('recetas.show')->with('mostrar_receta', $receta)
                                     ->with('like', $like)
                                     ->with('contar_likes', $likes);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function edit(Receta $receta)
    {
        //Revisar el policy
        $this->authorize('view', $receta);

        // obtener con Modelo
        $categorias = CategoriaReceta::all(['id', 'nombre']);
        return view('recetas.edit')
        ->with('categorias', $categorias)
        ->with('receta', $receta);
        // return view('recetas.edit', compact('categorias','receta'));  es = que with() pero más corto.
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Receta $receta)
    {
        //Revisar el policy
        $this->authorize('update', $receta);

        //Validación
        $data = $request->validate([
            'titulo' => 'required|min:6|max:35' ,
            'preparacion' => 'required|min:15',
            'ingredientes' => 'required|min:3',
            'imagen' => 'nullable|image', // 2 MB
           'categoria' => 'required'
        ]);

        //obtener la ruta de la imagen
        
            //Asiganr los valores
            $receta->titulo = $data['titulo'];
            $receta->preparacion = $data['preparacion'];
            $receta->ingredientes = $data['ingredientes'];
            $receta->categoria_id = $data['categoria'];
            
            //Si el usuario sube una nueva imagen
            if(request('imagen')) {

                $ruta_imagen = $request['imagen']->store('upload-recetas', 'public');

                // Resize de la imagen con intervention image
                $img = Image::make( public_path("storage/{$ruta_imagen}"))->fit(1024, 512);
                $img->save();

                //asiganar al Objeto
                $receta->imagen = $ruta_imagen;

            }

            $receta->save();//Guardar en Disco Duro.

            return redirect()->action('RecetaController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $delete =  Receta::where('id', $id)->delete();
        
         

         // Veridicar si la información es eliminada o no.
         if ($delete == 1) {
             $success = true;
             $message = "Receta eliminada exitosamente";
         } else {
             $success = false;
             $message = "Ups! no es posible eliminar la receta";
         }
         //  Return response
         return response()->json([
             'success' => $success,
             'message' => $message,
         ]);
         
         
          
    }

    public function search(Request $request ){

        //** realizan la misma acción */ 
        //** $buscar = $request ['buscar'];   |   $buscar = $request->get('buscar');  */ 

        $busqueda = $request->get('buscar');

        $recetas = Receta::where('titulo', 'like', '%' . $busqueda . '%' )->paginate(3);
        $recetas->appends(['buscar' => $busqueda]);

        return view('busquedas.show')->with('recetas', $recetas)
                                     ->with('busqueda', $busqueda);


    }


}
