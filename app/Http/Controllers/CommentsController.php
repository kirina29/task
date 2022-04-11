<?php

namespace App\Http\Controllers;
use App\Models\Comments;
use Illuminate\Support\Facades\App;

use Illuminate\Http\Request;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comment=Comments::orderby('created_at', 'asc')->paginate(7);
        return view('admins.comments.index')->withComment($comment);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admins.comments.create');
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
            'textcomment'=>'required'
        ]);
        $comment=new Comments([
            'textcomment'=>$request->get('textcomment')
        ]);
        $comment->save();
        return redirect('/admin/comments')->with('success', 'Комментарий добавлен');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cmnt=Comments::find($id);
        return view('admins.comments.show', compact('cmnt'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cmnt=Comments::find($id);
        return view('admins.comments.edit', compact('cmnt'));
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
            'textcomment'=>'required'
        ]);
        $comment=new Comments([
            'textcomment'=>$request->get('textcomment')
        ]);
        $comment->save();
        return redirect('/admin/comments')->with('success', 'Комментарий обновлён');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cmnt=Comments::find($id);
        $cmnt->delete();
        return redirect('/admin/comments')->with('success', 'Комментарий удалён');
    }
}
