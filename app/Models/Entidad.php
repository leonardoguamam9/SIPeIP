<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PDN;
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
     public function pdns()
    {
        return $this->hasMany(PDN::class, 'entidad_id');
    }
    
}
