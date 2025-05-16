<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservacion extends Model
{
    public $table = 'reservaciones';

    protected $primaryKey = 'id';

    protected $fillable = [
        'IdFuncion', 
        'FechaReserva',
        'Estado', // Ejemplo: 'pendiente', 'confirmada', 'cancelada'
        'Total' 
    ];

    // Relaciones
    public function funcion()
    {
        return $this->belongsTo(Funcion::class, 'IdFuncion');
    }

    public function asientos()
    {
        return $this->hasMany(AsientoReservado::class, 'IdReserva');
    }

    
}