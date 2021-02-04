<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    //Obtiene la información del usuario via FK
    public function autor()
    {
       return $this->belongsTo(User::class, 'user_id'); //indicar el nombre de la Clave foranea de la tabla.
    }

    //likes que ha recibido una recceta
    public function likes()
    {//Relaciión de muchos a muchos
        return $this->BelongsToMany(User::class, 'likes_receta');
    }
    
}
