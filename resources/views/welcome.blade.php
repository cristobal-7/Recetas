<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Resetas</title>

        <!-- Carpeta 5 | Video 4. Laravel Routing y Controllers   -->

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

     
    </head>
    <body>
        
           

@extends('layouts.app')

@section('botones')
<a href="{{ route('recetas.index') }}" class="btn btn-primary mr-2 text-while" >Lista de Receta</a>
@endsection

@section('content')
<div class="container">

    <h1>Bienvenido a e-recetas </h1>
    

</div>
@endsection


    </body>

    
</html>
