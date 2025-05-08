<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AsientoReservado extends Model
{
    public $table = "asientos_reservados";
    protected $primaryKey = "id"; // este es el id autoincremental

    protected $fillable = [
        'IdFuncion',
        'IdSala',
        'Fila',
        'NumeroAsiento'
    ];

    // Relaciones (opcional pero recomendable)
    public function funcion()
    {
        return $this->belongsTo(Funcion::class, 'IdFuncion');
    }

    public function sala()
    {
        return $this->belongsTo(Sala::class, 'IdSala');
    }

    
}
