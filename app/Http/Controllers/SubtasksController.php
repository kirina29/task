<?php

namespace App\Http\Controllers;
use App\Models\Subtasks;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;

class SubtasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subtask=Subtasks::orderby('created_at', 'asc')->paginate(7);
        return view('admins.subtasks.index')->withSubtask($subtask);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admins.subtasks.create');
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
            'start_date'=>'required',
            'deadline_date'=>'required'
            
        ]);
        $subtask=new Subtasks([
            'name'=>$request->get('name'),
            'start_date'=>$request->get('start_date'),
            'deadline_date'=>$request->get('deadline_date')
        ]);
        $subtask->save();
        return redirect('/admin/subtasks')->with('success', 'Подзадача добавлена');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sbtsk=Subtasks::find($id);
        return view('admins.subtasks.show', compact('sbtsk'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sbtsk=Subtasks::find($id);
        return view('admins.subtasks.edit', compact('sbtsk'));
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
            'start_date'=>'required',
            'deadline_date'=>'required'
            
        ]);
        $subtask=new Subtasks([
            'name'=>$request->get('name'),
            'start_date'=>$request->get('start_date'),
            'deadline_date'=>$request->get('deadline_date')
        ]);
        $subtask->save();
        return redirect('/admin/subtasks')->with('success', 'Подзадача обновлена');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sbtsk=Subtasks::find($id);
        $sbtsk->delete();
        return redirect('/admin/subtasks')->with('success', 'Подзадача удалена');
    }
}
