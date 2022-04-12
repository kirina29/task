<?php

namespace App\Http\Controllers;
use App\Models\Tasks;
use Illuminate\Support\Facades\App;

use Illuminate\Http\Request;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $task=Tasks::orderby('created_at', 'asc')->paginate(7);
        return view('admins.tasks.index')->withTask($task);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admins.tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|max: 100',
            'descriptions'=>'required',
            'price'=>'required',
            'start_date'=>'required',
            'deadline_date'=>'required'
            
        ]);
        $task=new Tasks([
            'name'=>$request->get('name'),
            'descriptions'=>$request->get('descriptions'),
            'price'=>$request->get('price'),
            'start_date'=>$request->get('start_date'),
            'deadline_date'=>$request->get('deadline_date')
            
        ]);
        $task->save();
        return redirect('/admin/tasks')->with('success', 'Задача добавлена');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tsk=Tasks::find($id);
        return view('admins.tasks.show', compact('tsk'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tsk=Tasks::find($id);
        return view('admins.tasks.edit', compact('tsk'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'required|max: 100',
            'descriptions'=>'required',
            'price'=>'required',
            'start_date'=>'required',
            'deadline_date'=>'required'
            
        ]);
        $task=Tasks::find($id);
        $task->name=$request->get('name');
        $task->descriptions=$request->get('descriptions');
        $task->price=$request->get('price');
        $task->start_date=$request->get('start_date');
        $task->deadline_date=$request->get('deadline_date');
        
        $task->save();
        return redirect('/admin/tasks')->with('success', 'Задача обновлена');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tsk=Tasks::find($id);
        $tsk->delete();
        return redirect('/admin/tasks')->with('success', 'Задача удалена');
    }
}
