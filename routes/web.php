<?php

use App\Http\Controllers\RecetaController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
/ | Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
| 
*/ 

Route::get('/', 'InicioController@index')->name('inicio.index');

// Rutas Recetas -- Sintaxis de la forma más descriptiva 
Route::get('/recetas', 'RecetaController@index')->name('recetas.index'); //->name() = es un alias para poder llamarlo desde la vista con el helper "route()" => href={{route('recetas.index')}} 
Route::get('/recetas/create', 'RecetaController@create')->name('recetas.create');
Route::post('/recetas', 'RecetaController@store')->name('recetas.store');
Route::get('/recetas/{receta}', 'RecetaController@show')->name('recetas.show');
Route::get('/recetas/{receta}/edit', 'RecetaController@edit')->name('recetas.edit');
Route::put('/recetas/{receta}', 'RecetaController@update')->name('recetas.update');
// // Route::delete('/recetas/{receta}', 'RecetaController@destroy')->name('recetas.destroy');
Route::post('/delete/{id}', 'RecetaController@destroy')->name('recetas.destroy');

//Rutas Recetas -- Sintaxis simplificada
//Route::resource('recetas', 'RecetaController');

//Buscador Recetas
Route::get('/buscar', 'RecetaController@search')->name('buscar.show');

 //Perfiles
Route::get('/perfiles/{perfil}', 'PerfilController@show')->name('perfiles.show');
Route::get('/perfiles/{perfil}/edit','PerfilController@edit')->name('perfiles.edit');
Route::put('/perfiles/{perfil}','PerfilController@update')->name('perfiles.update');

//Likes Recetas
Route::post('/recetas/{receta}', 'LikesController@update')->name('likes.update');

//Categoria receta
Route::get('categoria/{categoriaReceta}', 'CategoriasController@show')->name('categorias.show');

Auth::routes();


//  Route::get('/recetas', 'RecetaController');
// Route::get('/home', 'HomeController@index')->name('home');
