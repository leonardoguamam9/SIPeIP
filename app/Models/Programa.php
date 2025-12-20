<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programa extends Model
{
    use HasFactory;

    // ✅ Nombre real de la tabla en MySQL
    protected $table = 'programas';

    // ✅ Campos que SÍ se pueden guardar (asignación masiva)
    protected $fillable = [
        'nombrePrograma',
        'tipoPrograma',
        'descripcionPrograma',
        'estadoPrograma',
        'responsablePrograma'
    ];
}
