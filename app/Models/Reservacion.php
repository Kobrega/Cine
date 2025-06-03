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
        'asiento',
        'Total'
    ];


}