<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\IncidentPost;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function favorite(IncidentPost $incidentPost, Request $request)
    {
        $favorite = New Favorite();
        $favorite->incident_post_id = $incidentPost->id;
        $favorite->user_id = Auth::user()->id;
        $favorite->save();
        return back();
    }

    public function unfavorite(IncidentPost $incidentPost, Request $request)
    {
        $user = Auth::user()->id;
        $favorite = Favorite::where('incident_post_id', $incidentPost->id)->where('user_id', $user)->first();
        $favorite->delete();
        return back();
    }
}
