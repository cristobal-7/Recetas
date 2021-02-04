<?php

namespace App;

use App\Receta;
use App\Perfil;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'url'
    ];

    /**
     * The attributes that should be hidden for arrays.
     * 
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    protected static function boot()
    {
        parent::boot();

        //asignar perfil una vez haya creado un usuario nuevo
        static::created(function($user){
            $user->perfil()->create();
        });
    }
    /**
     * Relaciòn 1:n de Usuario a recetas, esta relación es accedida desde el controlador en el metodo index
     */
    public function recetas(){

        return $this->hasMany(Receta::class);
    }

   /** 
    * Relación 1:1 de usuario a Perfil
    */
    public function perfil(){

        return $this->hasOne(Perfil::class);
    }

    //relación inversa de Likes - Reecctas a las qeu el usuario le ha dado me gusta.
    public function meGusta()
    {
        return $this->belongsToMany(Receta::class, 'likes_receta');
    }

}
