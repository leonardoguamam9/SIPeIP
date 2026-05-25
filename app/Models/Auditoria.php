<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Auditoria extends Model
{
    //
     protected $table = 'auditorias';

    protected $fillable = [
        'user_id',
        'accion',
        'modulo',
        'descripcion',
        'ip'
    ];

    // Relación usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
