<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AsientoReservado extends Model
{
    public $table = "asientos_reservados";
    protected $primaryKey = "IdReserva";

    protected $fillable = [
        'IdSala',
        'Fila',
        'NumeroAsiento'
    ];

    protected $hidden = [];
}
