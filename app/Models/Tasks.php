<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $appends = ["open"];

    public function getOpenAttribute(){
        return true;
    }

    public function status()
    {
        return $this->belongsTo(Statuses::class, 'id_statuses');
    }
    public function subtasks()
    {
        return $this->hasMany(Subtasks::class, 'id_tasks');
    }

}
