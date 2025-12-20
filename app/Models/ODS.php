<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


 class ODS extends Model
{
    use HasFactory;

    protected $table = 'o_d_s';

    protected $fillable = [
        'nombreODS',
        'tipoODS',
        'descripcionODS'
    ];
}

