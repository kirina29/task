<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statuses extends Model
{
    use HasFactory;

    public function tasks()
    {
        return $this->hasMany(Tasks::class, 'id_statuses');
    }

    public function subtasks()
    {
        return $this->hasMany(Tasks::class, 'id_statuses');
    }
}
