<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//ANGEL GAY
class Salas extends Model
{
    public $table = "salas";
    
    protected $primaryKey = "IdSala";

    /**
     * the atributes that are mass assignable
     * 
     * @var array
     */
    protected $fillable = [
        'TipoProyector','CantidadAsientos','TipoSala'
    ];

    protected $hidden = [];
}
