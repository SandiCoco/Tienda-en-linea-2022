<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'descuento',
        'fecha_inicio',
        'fecha_fin',
    ];
}
