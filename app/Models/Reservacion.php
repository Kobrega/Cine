<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservacion extends Model
{
    public $table = 'reservaciones';

    protected $primaryKey = 'id';

    protected $fillable = ['IdFuncion', 'IdSala', 'Fila', 'NumeroAsiento'];


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
