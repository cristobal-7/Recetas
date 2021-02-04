<?php

namespace App\Http\Controllers;

use App\Receta;
use App\CategoriaReceta;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class InicioController extends Controller
{
   public function index()
   {

      //Mostrar las recetas por cantidad de votos
      //$votadas = Receta::has('likes', '>', 1 )->get();
      
      //withCount crea un campo nuevo que es likes_count, ('likes') es la relación que esta en el modelo Receta.php
      $votadas = Receta::withCount('likes')->orderBy('likes_count', 'desc')->take(3)->get();
      
       //Obtener las recetas más nuevas
       // $var = Receta::orderBy('created_at', 'DESC')->get(); mostrara en orden descendente y ASC es orden ascendente.
       // esto es igual a Recetas::latest()->get(); siempre y cuando estemos trabajando con la columna 'created_at' 
       // ó le podemos pasar el nombre de la columna como parametro ::latest('usuarios')->get)();  -- el inverso es ::oldest()->get();
       
       //latest()->take(3) ó latest()->limit(3)  ambos limitan una cantidad de recetas a mostar
       $nuevas = Receta::latest()->take(6)->get(); 

       //Obtener todas las categorias
       $categorias = CategoriaReceta::all();
      //  return $categorias;

       //Agrupar las recetas por categorias
       $recetas = [];

       foreach($categorias as $categoria){
          $recetas[ Str::slug($categoria->nombre) ] [] = Receta::where('categoria_id', $categoria->id)->take('3')->get();
       }

        return view('inicio.index')->with('recetas_nuevas', $nuevas )
                                   ->with('recetas_categoria', $recetas)
                                   ->with('votadas', $votadas);
   }

}
