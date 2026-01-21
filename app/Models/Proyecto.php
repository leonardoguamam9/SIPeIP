<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    use HasFactory;

    protected $table = 'proyectos';

    protected $fillable = [
        'nombreProyecto',
        'descripcionProyecto',
        'estadoProyecto',
        'responsableProyecto',
        'programa_id'
    ];

    public function programa()
    {
        return $this->belongsTo(Programa::class);
    }

    public function indicadores() {
    return $this->hasMany(Indicador::class, 'proyecto_id');
}
}
