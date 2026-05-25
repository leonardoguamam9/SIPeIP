<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConfiguracionInstitucional extends Model
{
    //
  protected $table = 'configuracion_institucional';

    protected $fillable = [
        'nombreInstitucion',
        'direccion',
        'telefono',
        'correo',
        'periodoFiscal',
        'responsable'
    ];
}
