<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrecioXEdad extends Model
{
    public $table = "precio_x_edad";
    
    protected $primaryKey = "IdPrecioXEdad";

    /**
     * the atributes that are mass assignable
     * 
     * @var array
     */
    protected $fillable = [
        'BoletoXEdad','Precio'
    ];

    protected $hidden = [];
}
