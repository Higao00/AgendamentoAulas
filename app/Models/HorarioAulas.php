<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HorarioAulas extends Model
{
    protected $fillable = ['user_id', 'materia_id', 'data', 'hora_inicio', 'hora_fim'];

    use HasFactory;


    public function user()
    {
        return  $this->hasMany(User::class, 'id', 'user_id');
    }

    public function materia()
    {
        return $this->hasMany(Materias::class, 'id', 'materia_id');
    }
}
