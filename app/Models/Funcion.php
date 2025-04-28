<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Funcion extends Model
{
    public $table = 'funciones';
    protected $primaryKey = 'IdFuncion';

    protected $fillable = [
        'IdSalasPeli',
        'Fecha',
        'HoraInicio',
        'HoraFin'
    ];

    protected $hidden = [];

    public function salas_peliculas()
    {
        return $this->belongsTo(SalasPelicula::class, 'IdSalasPeli');
    }
}
