<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OE extends Model
{
    //
    use HasFactory;

    protected $table = 'oes';

    protected $fillable = [
        'codigoOE',
        'nombreOE',
        'descripcionOE',
        'estadoOE',
        'entidad_id',
        'pdn_id',
    ];
    
    public function entidad()
    {
        return $this->belongsTo(Entidad::class);
    }

     public function pdn()
    {
        return $this->belongsTo(PDN::class);
    }

}
