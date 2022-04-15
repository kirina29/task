<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flags extends Model
{
    use HasFactory;

    public function tasks()
    {
        return $this->hasMany(Tasks::class, 'id_flags');
    }
}
