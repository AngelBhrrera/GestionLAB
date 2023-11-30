<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedallaUser extends Model
{
    use HasFactory;

    protected $table = 'medalla_user';

    protected $fillable = [
        'medalla_nivel', 'user_id'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'medalla_user', 'medalla_nivel', 'user_id');
    }
}
