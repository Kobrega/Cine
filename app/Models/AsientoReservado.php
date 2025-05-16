<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AsientoReservado extends Model
{
    public $table = "asientos_reservados";
    protected $primaryKey = "id"; 

    protected $fillable = [
        'IdReserva', 
        'IdFuncion',
        'IdSala',
        'Fila',
        'NumeroAsiento'
    ];

    // Relaciones
    public function funcion()
    {
        return $this->belongsTo(Funcion::class, 'IdFuncion');
    }

    public function sala()
    {
        return $this->belongsTo(Sala::class, 'IdSala');
    }

    public function reservacion()
    {
        return $this->belongsTo(Reservacion::class, 'IdReserva');
    }
}