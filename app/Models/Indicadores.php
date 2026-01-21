<?php

namespace App\Models;
use App\Models\Metas;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Indicadores extends Model
{
    //
    use HasFactory;

    protected $table = 'indicadores';

    protected $fillable = [
        'codigoIndicador',
        'nombreIndicador',
        'descripcionIndicador',
        'tipoIndicador',
        'formulaIndicador',
        'estadoIndicador',
        'meta_id',
    ];
    public function meta()
    {
        return $this->belongsTo(Metas::class, 'meta_id');
    }
    
    public function metas() {
    return $this->hasMany(Meta::class, 'indicador_id');
}
}

  