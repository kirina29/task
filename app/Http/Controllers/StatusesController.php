<?php

namespace App\Http\Controllers;
use App\Models\Statuses;
use Illuminate\Support\Facades\App;

use Illuminate\Http\Request;

class StatusesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $status=Statuses::orderby('created_at', 'asc')->paginate(7);
        return view('admins.statuses.index')->withStatus($status);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admins.statuses.create');
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
            'name'=>'required|max: 100'
        ]);
        $status=new Statuses([
            'name'=>$request->get('name')
        ]);
        $status->save();
        return redirect('/admin/statuses')->with('success', 'Статус добавлен');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $stts=Statuses::find($id);
        return view('admins.statuses.show', compact('stts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $stts=Statuses::find($id);
        return view('admins.statuses.edit', compact('stts'));
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
            'name'=>'required|max: 100'
        ]);
        $status=Statuses::find($id);
        $status->name=$request->get('name');

        $status->save();
        return redirect('/admin/statuses')->with('success', 'Статус обновлён');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $stts=Statuses::find($id);
        $stts->delete();
        return redirect('/admin/statuses')->with('success', 'Статус удалён');
    }
}
