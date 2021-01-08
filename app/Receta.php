<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Receta extends Model
{

    use Notifiable;

    /** 
     * The attributes that are mass assignable.
     *
     * @var array
     */

     //campos que se agregaran
    protected $fillable = [
        'titulo', 'preparacion', 'ingredientes', 'imagen', 'categoria_id','created_at',
    ];
    //Obtiene la categoria de la receta via FK -- es lo inverso de hasOne.
    public function categoria()
    {
        return $this->belongsTo(CategoriaReceta::class);

    }
    
}
