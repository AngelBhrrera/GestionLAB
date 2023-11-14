<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitas extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'name',
        'apellido',
        'numero',
        'fecha',
        'hora_llegada',
        'hora_salida',
        'fecha_salida',
        'motivo',
        'responsable'

    ];
}
