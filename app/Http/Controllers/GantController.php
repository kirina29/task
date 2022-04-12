<?php

namespace App\Http\Controllers;
use App\Models\Subtasks;
use App\Models\Tasks;
use Illuminate\Support\Facades\App;
use App\Http\Resources\TaskResource;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GantController extends Controller
{
    public function index($id)
    {
        $tasks=TaskResource::collection(Tasks::where('id_users', $id)->get());
        return response()->json($tasks);
    }
}
