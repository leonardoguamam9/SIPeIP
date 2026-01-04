<?php

namespace App\Models;
use App\Models\OE;
use App\Models\Indicadores;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Metas extends Model
{
    //
      use HasFactory;

    protected $table = 'metas';

    protected $fillable = [
        'codigoMeta',
        'nombreMeta',
        'descripcionMeta',
        'estadoMeta',
        'oe_id',
    ];
     public function oe()
    {
        return $this->belongsTo(OE::class, 'oe_id');
    }
    

    public function indicadores()
    {
        return $this->hasMany(Indicadores::class, 'meta_id');
    }

}
