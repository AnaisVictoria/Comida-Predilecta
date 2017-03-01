<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingrediente extends Model
{
    protected $table = "ingrediente";

    protected $fillable = [
    	'nombre','cantidad','precio'				
    ];

    public function comidaIngrediente()
    {
    	return $this->hasMany('App\Comida_Ingrediente','id_ingrediente');
  	}
    
    //Validacion de ingreso de un ingrediente, primera letra may, demas en minusculas
    
    public function setnombreAttribute($value){
        $this->attributes['nombre'] = ucfirst(strtoLower($value));
    }

}
