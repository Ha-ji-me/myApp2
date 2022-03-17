<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IncidentPost;
use App\Models\Comment;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $incidentPosts = IncidentPost::orderBy('created_at','desc')->where(function($query){
            //検索機能
            if ($search = request('search')) {
                $query->where('title', 'LIKE', "%{$search}%")->orWhere('body', 'LIKE', "%{$search}%");
            }
        })->paginate(10);

        $user = auth()->user();
        return view('home',compact('incidentPosts','user'));
    }

    public function myPost()
    {
        $user = auth()->user();
        $userId = auth()->user()->id;
        $incidentPosts = IncidentPost::where('user_id', $userId)->orderBy('created_at', 'desc')->get();
        return view('my_post', compact('incidentPosts','user'));
    }

    public function myComment() {
        $user = auth()->user();
        $userId = auth()->user()->id;
        $comments = Comment::where('user_id', $userId)->orderBy('created_at', 'desc')->get();
        return view('my_comment', compact('comments','user'));
    }
}
