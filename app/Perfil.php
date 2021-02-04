<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    /** 
     * The attributes that are mass assignable.
     *
     * @var array
     */

     //campos que se agregaran
     protected $fillable = [
        'user_id', 'biografia', 'imagen', 'categoria_id','created_at',
    ];


    /**
     * Relación 1:1 de perfil a usuario
     */
    public function usuario(){

        return $this->belongsTo(User::class, 'user_id');
    }
}
