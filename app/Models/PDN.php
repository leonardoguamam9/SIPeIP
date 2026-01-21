<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PDN extends Model
{
    use HasFactory;

    protected $table = 'pdns';

    protected $fillable = [
        'codigoPDN',
        'nombrePDN',
        'descripcionPDN',
        'anio_inicio',
        'anio_fin',
        'horizonte_planificacion',
        'fecha_aprobacion',
        'resolucion_aprobacion',
        'entidad_id',
        'users_id',
        'responsable_pdn',
        'documentoPDN',
        'url_repositorio',
        'observaciones',
        'estadoPDN'
    ];

    public function entidad()
    {
        return $this->belongsTo(Entidad::class, 'entidad_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function oes()
    {
        return $this->hasMany(OE::class, 'pdn_id');
    }

}
