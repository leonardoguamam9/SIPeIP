<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Entidad extends Model

{
    protected $table = 'entidad';
    protected $fillable = [
        
        'nombreEntidad',
        'tipoEntidad',
        'direccionEntidad',
        'subSector',
        'responsable'
    ];
    
}
