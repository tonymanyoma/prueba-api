<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
     /**
     * Tabla asociada con el modelo
     * @var string
     */
    protected $table = "clientes";

    /**
     * @var array
     */
    protected $fillable = [
        'email','nombre', 'apellidos', 'telefono', 'direccion', 'foto'
    ];

    /**
     * @var boolean
     */
    public $timestamps = true;
}
