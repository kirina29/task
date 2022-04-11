<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subtasks extends Model
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

    public function users()
    {
        return $this->belongsToMany(User::class, 'users_subtasks','id_subtasks', 'id_users');
    }

    public function task()
    {
        return $this->belongsTo(Tasks::class, 'id_tasks');
    }
}
