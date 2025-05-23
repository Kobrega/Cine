<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalasPelicula extends Model
{
    public $table = "salas_peliculas";
    
    protected $primaryKey = "IdSalasPeli";

    /**
     * the atributes that are mass assignable
     * 
     * @var array
     */
    protected $fillable = [
        'IdPelicula','IdSala'
    ];

    protected $hidden = [];

    public function pelicula()
    {
        return $this->belongsTo(Peliculas::class, 'IdPelicula');
    }

    public function sala()
    {
        return $this->belongsTo(Salas::class, 'IdSala');
    }
}
