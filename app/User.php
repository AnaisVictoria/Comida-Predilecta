<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
     //protected $table = "user";
    protected $primaryKey = 'cedula';
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'password', 'telefono', 'direccion', 'cedula'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    //Un usuario puede tener muchas ventas
    public function ventas()
    {
        return $this->hasMany('App/Venta');
    }

        //Validacion de ingreso de un nombre, primera letra may, demas en minusculas
    
    public function setnombreAttribute($value){
        $this->attributes['nombre'] = ucfirst(strtoLower($value));
    }
}
