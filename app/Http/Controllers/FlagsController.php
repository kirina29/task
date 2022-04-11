<?php

namespace App\Http\Controllers;
use App\Models\Flags;
use Illuminate\Support\Facades\App;

use Illuminate\Http\Request;

class FlagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $flag=Flags::orderby('created_at', 'asc')->paginate(7);
        return view('admins.flags.index')->withFlag($flag);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admins.flags.create');

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
        $flag=new Flags([
            'name'=>$request->get('name')
        ]);
        $flag->save();
        return redirect('/admin/flags')->with('success', 'Метка добавлена');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $flg=Flags::find($id);
        return view('admins.flags.show', compact('flg'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $flg=Flags::find($id);
        return view('admins.flags.edit', compact('flg'));
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
        $flag=Flags::find($id);
        $flag->name=$request->get('name');

        $flag->save();
        return redirect('/admin/flags')->with('success', 'Метка обновлена');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $flg=Flags::find($id);
        $flg->delete();
        return redirect('/admin/flags')->with('success', 'Метка удалена');
    }
}
