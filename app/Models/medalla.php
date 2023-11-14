<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class medalla extends Model
{
    use HasFactory;

    protected $table = 'medallas';
    protected $primaryKey = 'nivel';


    protected $fillable = [
        'nivel', 'ruta', 'descripcion'
    ];
}
