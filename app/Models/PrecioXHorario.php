<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrecioXHorario extends Model
{
    public $table = "precio_x_horario";
    
    protected $primaryKey = "IdPrecioXHorario";

    /**
     * the atributes that are mass assignable
     * 
     * @var array
     */
    protected $fillable = [
        'BoletoXHorario','Precio'
    ];

    protected $hidden = [];
}
