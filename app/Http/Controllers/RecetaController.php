<?php

namespace App\Http\Controllers;

use App\Receta;
use App\User;
use App\CategoriaReceta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class RecetaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
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

        $recetas = auth()->user()->recetas;

        return view('recetas.index')->with('recetas', $recetas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Esta es la forma de obtener las categorias (sin modelos)
        $categorias = DB::table('categoria_recetas')->get()->pluck('nombre', 'id');

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
        return view('recetas.show')->with('mostrar_receta', $receta);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function edit(Receta $receta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Receta $receta)
    {
        //
    }
}
