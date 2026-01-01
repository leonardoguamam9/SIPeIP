<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PDN extends Model
{
    //
    use HasFactory;

    protected $table = 'pdns';

    protected $fillable = [
        'codigoPDN',
        'nombrePDN',
        'descripcionPDN',
        'estadoPDN',
    ];


}
