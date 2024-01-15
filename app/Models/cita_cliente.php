<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cita_cliente extends Model
{
    use HasFactory;
    public $timestamps = false;

protected $fillable = [
    'id_citas',
    'id',
    'correo',
    'nombre',
    'telefono',
    //'carrera',
    //'semestre',
    // 'credencial',
    'N_piezas',
    'proyecto',
    // 'render',
    // 'ArchivoSTL',
    'observaciones',
    'fecha',
    'status',
    'palabrasClave',
    'introduccion',
    'trabajosRelacionados',
    'propuesta',
    'conclusion',
    'enlaceDrive',
    
];
}
