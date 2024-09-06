<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sala extends Model
{
    use HasFactory;

    /**
     * Los atributos que son asignables en masa.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
    ];

    /**
     * Los atributos que deberían ser ocultados para arreglos.
     *
     * @var array
     */
    protected $hidden = [
        // Aquí puedes añadir campos que deseas ocultar al convertir a JSON
    ];

    /**
     * Los atributos que deberían ser lanzados como fechas.
     *
     * @var array
     */
    protected $dates = [
        // Aquí puedes añadir campos que deseas que se traten como fechas
    ];
}
