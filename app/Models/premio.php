<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class premio extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    protected $fillable = [
      'id',
      'nombre',
      'descripcion',
      'tipo',
      'horas'
    ];
}
