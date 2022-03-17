<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IncidentPost;

class IncidentPostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->user();
        return view('incident_post.create',compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputs=$request->validate
        ([
            'title'=>'required|max:255',
            'body'=>'required|max:255',
            'image'=>'image|max:1024'
        ]);
        $incidentPost = new IncidentPost();
        $incidentPost->title=$request->title;
        $incidentPost->body=$request->body;
        $incidentPost->user_id=auth()->user()->id;

        if (request('image'))
        {
            $original = request()->file('image')->getClientOriginalName();
             // 日時追加
            $name = date('Ymd_His').'_'.$original;
            request()->file('image')->move('storage/images', $name);
            $incidentPost->image = $name;
        }

        $incidentPost->save();
        return redirect()->route('incident-post.create')->with('message', '投稿を作成しました');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(IncidentPost $incidentPost)
    {
        return view('incident_post.show', compact('incidentPost'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(IncidentPost $incidentPost)
    {
        $this->authorize('update', $incidentPost);

        return view('incident_post.edit', compact('incidentPost'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, IncidentPost $incidentPost)
    {
        $this->authorize('update', $incidentPost);

        $inputs=$request->validate([
            'title'=>'required|max:255',
            'body'=>'required|max:255',
            'image'=>'image|max:1024'
        ]);

        $incidentPost->title=$inputs['title'];
        $incidentPost->body=$inputs['body'];

        if(request('image')){
            $original=request()->file('image')->getClientOriginalName();
            $name=date('Ymd_His').'_'.$original;
            $file=request()->file('image')->move('storage/images', $name);
            $incidentPost->image=$name;
        }

        $incidentPost->save();

        return back()->with('message', '投稿を更新しました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(IncidentPost $incidentPost)
    {
        $this->authorize('delete', $incidentPost);

        $incidentPost->comments()->delete();
        $incidentPost->delete();
        return redirect()->route('home')->with('message', '投稿を削除しました');
    }
}
