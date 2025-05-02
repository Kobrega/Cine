<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PreciosXTipoSala extends Model
{
    public $table = "precios_x_tipo_salas";
    
    protected $primaryKey = "IdPrecioTipoSala";

    /**
     * the atributes that are mass assignable
     * 
     * @var array
     */
    protected $fillable = [
        'IdSala','BoletoXTipo','Precio'
    ];

    protected $hidden = [];
}
