<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cine extends Model
{
    public $table = "cines";
    
    protected $primaryKey = "IdCine";

    /**
     * the atributes that are mass assignable
     * 
     * @var array
     */
    protected $fillable = [
        'NomCine','Direccion','HorarioA','HorarioC'
    ];

    protected $hidden = [];
}
