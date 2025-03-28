<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CinesSalas extends Model
{
    public $table = "cines_salas";
    
    protected $primaryKey = "IdCineSala";

    /**
     * the atributes that are mass assignable
     * 
     * @var array
     */
    protected $fillable = [
        'IdCine','IdSala'
    ];

    protected $hidden = [];
}
