<?php

namespace App\Http\Controllers;
use App\Models\Spaces;
use Illuminate\Support\Facades\App;

use Illuminate\Http\Request;

class SpacesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $space=Spaces::orderby('created_at', 'asc')->paginate(7);
        return view('admins.spaces.index')->withSpace($space);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admins.spaces.create');
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
        $space=new Statuses([
            'name'=>$request->get('name')
        ]);
        $space->save();
        return redirect('/admin/spaces')->with('success', 'Пространство добавлено');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $spc=Spaces::find($id);
        return view('admins.spaces.show', compact('spc'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $spc=Spaces::find($id);
        return view('admins.spaces.edit', compact('spc'));
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
        $space=new Statuses([
            'name'=>$request->get('name')
        ]);
        $space->save();
        return redirect('/admin/spaces')->with('success', 'Пространство обновлено');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $spc=Spaces::find($id);
        $spc->delete();
        return redirect('/admin/spaces')->with('success', 'Пространство удалено');
    }
}
