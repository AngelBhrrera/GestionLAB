<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class faltas extends Model
{
    public $timestamps = false;

protected $fillable = [
    'id_usuario',
    'fecha',
    'nombre',
    'apellido',
    'correo'

];
}
