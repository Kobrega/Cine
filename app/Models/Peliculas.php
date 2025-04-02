<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peliculas extends Model
{
    public $table = "peliculas";
    
    protected $primaryKey = "IdPelicula";

    /**
     * the atributes that are mass assignable
     * 
     * @var array
     */
    protected $fillable = [
        'NomPelicula','Duracion','Clasificacion'
    ];

    protected $hidden = [];
}
