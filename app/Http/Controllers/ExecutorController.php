<?php

namespace App\Http\Controllers;
use App\Models\Subtasks;
use App\Models\Tasks;
use App\Models\User;
use Illuminate\Support\Facades\App;
use App\Http\Resources\TaskResource;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExecutorController extends Controller
{
    public function index($name)
    {
        $executor=User::where('name', 'like',"%$name%")->get();
        return response()->json($executor, 200);
    }
}
