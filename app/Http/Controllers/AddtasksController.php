<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use App\Models\Flags;
use App\Models\Users_subtasks;
use Illuminate\Http\Request;
use App\Models\Tasks;
use App\Models\Subtasks;
use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use PhpParser\Comment;

class AddtasksController extends Controller
{
    public function read(){
        $us=User::all();
        $group=$us->groupBy('id');
        $tag=Flags::all();
        $comment=Comments::all();

        $l=Tasks::join('statuses', 'statuses.id', '=', 'tasks.id_statuses')
            ->select('tasks.*', 'statuses.name as status')
            ->where('id_users', Auth::id())
            ->get();


        $s=Subtasks::join('statuses', 'statuses.id', '=', 'subtasks.id_statuses')
            ->select('subtasks.*', 'statuses.name as status')
            ->get();
        $execut=Users_subtasks::all();
        for ($i=0;$i<count($tag);$i++){
            if($tag[$i]->name==='Важно'){
                $tag[$i]['color']='#FFFF00';
            }
            else if($tag[$i]->name==='Срочно'){
                $tag[$i]['color']='#FF0000';
            }
            else if($tag[$i]->name==='Несущественно'){
                $tag[$i]['color']='#008000';
            }
        }
        return view('dashboard', ['resultsubtask'=>$s,'users'=>$group, 'res'=>$l, 'execut'=>$execut, 'tags'=>$tag, 'comment'=>$comment]);
    }

    public function board(){
//        $b=Tasks::all();
        $b=Tasks::join('statuses', 'statuses.id', '=', 'tasks.id_statuses')
            ->select('tasks.*', 'statuses.name as status')
            ->where('id_users', Auth::id())
            ->get();
        return view('board', ['result'=>$b]);
    }

    public function addtask(Request $request){
        $temp1=$request->name;
        $temp2=$request->descriptions;
        $temp3=$request->price;
        $temp4=$request->start_date;
        $temp5=$request->deadline_date;

        $q=DB::table('tasks')->insert([
            'name'=>$temp1,
            'descriptions'=>$temp2,
            'price'=>$temp3,
            'start_date'=>$temp4,
            'deadline_date'=>$temp5,
            'id_statuses' => "1",
            'id_spaces' => "1",
            'id_users'=>Auth::id()
         ]);
        return redirect()->route('dashboard');
    }

    public function destroy($id){
        $rs=Subtasks::where('id_tasks', $id)->delete();
//        $rs->delete();
        $r=Tasks::find($id);
        $r->delete();
        return redirect()->route('dashboard');
    }

    public function destroySub($id){
        $su=DB::table('users_subtasks')->where('id_subtasks', $id)->delete();
        $rs=Subtasks::find($id);
        $rs->delete();
        return redirect()->route('dashboard_read');
    }

    public function checktask($id){
        $r=Tasks::find($id);
        $r->update(['id_statuses' => "3" ]);

        return redirect()->route('dashboard');
    }
    public function checksubtask($id){
        $r=Subtasks::find($id);
        $r->update(['id_statuses' => "3" ]);

        return redirect()->route('dashboard');
    }

    public function addsubtask(Request $request, $id){
        $temp1=$request->name;
        $temp4=$request->start_date;
        $temp5=$request->deadline_date;
        $execut=[];
        $q=Subtasks::create([
            'name'=>$temp1,
            'start_date'=>$temp4,
            'deadline_date'=>$temp5,
            'id_tasks'=>$id,
            'id_statuses' => "1",
         ]);
        foreach ($request->executor as $ex){
            if($ex!=null){
                array_push($execut, $ex);
            }
        }
        $q->users()->attach($execut);
         return redirect()->route('dashboard');

        }
    public function upsubtask(Request $request, $id){
        $name=$request->nameUpdSub;
        $start=$request->start_dateUpdSub;
        $deadline=$request->deadline_dateUpdSub;
        $subtask=Subtasks::find($id);
        $execut=[];
        $subtask->update([
            'name'=>$name,
            'deadline_date'=>$deadline,
            'start_date'=>$start
        ]);
        foreach ($request->executor as $ex){
            if($ex!=null){
                array_push($execut, $ex);
            }
        }
        $subtask->users()->detach();
        $subtask->users()->attach($execut);
        return redirect()->route('dashboard');
    }
    public function uptask(Request $request, $id){
        $name=$request->nameUpdTask;
        $descriptions=$request->descriptionsUpdTask;
        $price=$request->priceUpdTask;
        $start=$request->start_dateUpdTask;
        $deadline=$request->deadline_dateUpdTask;
        $task=Tasks::find($id);
        $task->update([
            'name'=>$name,
            'descriptions'=>$descriptions,
            'price'=>$price,
            'deadline_date'=>$deadline,
            'start_date'=>$start,
            'id_flags'=>$request->flags
        ]);
        return redirect()->route('dashboard');
    }

    public function addcomment(Request $request, $id)
    {
        $comment=Comments::create([
            'textcomment'=>$request->textcomment,
            'id_subtasks'=>$id
        ]);

        return redirect()->route('dashboard');
    }

    public function updateStatus(Request $request, $id)
    {
        $task=Tasks::find($id);
        $task->update($request->all());
        return response()->json($task)->setStatusCode(200, 'Ok');
    }

    public function calendar()
    {
        $tasks=Tasks::where('id_users', Auth::id())->get();
        return view('calendar', ['result'=>$tasks]);
    }
    public function gant()
    {
        return view('gant', ['id'=>Auth::id()]);
    }
    public function subtask()
    {
        $s=Subtasks::join('statuses', 'statuses.id', '=', 'subtasks.id_statuses')
            ->join('users_subtasks', 'subtasks.id', '=', 'users_subtasks.id_subtasks')
            ->join('tasks', 'tasks.id', '=', 'subtasks.id_tasks')
            ->select('subtasks.*', 'statuses.name as status', 'tasks.id_users as user')
            ->where('users_subtasks.id_users', Auth::id())
            ->get();
        $users=User::all();
        $execut=Users_subtasks::all();
        $comment=Comments::all();
        $group=$users->groupBy('id');
        return view('subtask', ['resultsubtask'=>$s, 'user'=>$group, 'users'=>$users, 'execut'=>$execut, 'comment'=>$comment]);
    }
}
