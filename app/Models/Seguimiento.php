<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seguimiento extends Model
{
    //
    protected $fillable = [
        'proyecto_id',
        'avance',
        'observaciones',
        'fechaSeguimiento',
        'estado'
];
public function proyecto()
    {
        return $this->belongsTo(Proyecto::class);
    }


}
