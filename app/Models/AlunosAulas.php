<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlunosAulas extends Model
{
    protected $fillable = ['hora_id', 'user_id', 'status'];

    use HasFactory;

    public function user()
    {
        return  $this->hasMany(User::class, 'id', 'user_id');
    }

    public function horarioAula()
    {
        return $this->hasMany(HorarioAulas::class, 'id', 'hora_id');
    }
}
