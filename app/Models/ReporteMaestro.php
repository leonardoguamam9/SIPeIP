<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReporteMaestro extends Model
{
    protected $table = 'reporte_maestros';

    protected $fillable = [
        'user_id',
        'entidad_id',
        'pdn_id',
        'ods_id',
        'plan_id',
        'meta_id', 
        'programa_id',
        'proyecto_id'
    ];

    
    /**
     * Relación con la Entidad Institucional
     */
    public function entidad()
    {
        return $this->belongsTo(Entidad::class, 'entidad_id');
    }

    /**
     * Relación con el Plan Nacional de Desarrollo (PDN)
     */
    public function pdn()
    {
        return $this->belongsTo(PDN::class, 'pdn_id');
    }

    /**
     * Relación con el Plan Institucional
     */
    public function plan()
    {
        return $this->belongsTo(Plan::class, 'plan_id');
    }

    /**
     * Relación con el Proyecto de Inversión Pública
     */
    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'proyecto_id');
    }

    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}