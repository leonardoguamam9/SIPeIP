<?php

namespace App\Models;
use App\Models\Entidad;

use Illuminate\Database\Eloquent\Model;

class IntegracionFinanzas extends Model
{
    protected $table = 'integracion_finanzas';

    protected $fillable = [
        'codigoIntegracion',
        'entidad_id',
        'montoPresupuesto',
        'fechaEnvio',
        'estado',
        'observaciones'
    ];
    public function entidad()
{
    return $this->belongsTo(\App\Models\Entidad::class);
}
}