<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $table = 'plans';

    protected $fillable = [
        'nombrePlan',
        'descripcionPlan',
        'estadoPlan',
        'fechaInicio',
        'fechaFin',
        'entidad_id'
    ];

    //Un Plan pertenece a una Entidad
    public function entidad()
    {
        return $this->belongsTo(Entidad::class);
    }
}
