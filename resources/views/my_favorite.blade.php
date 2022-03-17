@extends('layouts.app')
@section('content')

@if(session('message'))
<div class="alert alert-success">{{session('message')}}</div>
@endif
<div class="ml-2 mb-3">
    <h2 style="text-align:center">お気に入りにした投稿<h2>
</div>

@if (count($favorites) == 0)
<h4 style="text-align: center;">
＊あなたがお気に入りにした投稿はまだありません
</h4>
@else
@foreach ($favorites->unique('incident_post_id') as $favorite)
@php
    $incidentPost = $favorite->incidentPost;
@endphp
<div class="container-fluid mt-20" style="margin-left:-10px;">
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <div class="media flex-wrap w-100 align-items-center">
                        <img src="{{asset('storage/avatar/'.($incidentPost->user->avatar??'user_default.jpg'))}}"
                        class="rounded-circle" style="width:40px;height:40px;">
                        <div class="media-body ml-3">
                        <a href="{{route('incident-post.show', $incidentPost)}}" class="text-dark">
                            {{$incidentPost->title}}
                        </a>
                            <div class="text-muted small">{{$incidentPost->user->name ?? '削除されたユーザー'}}</div>
                        </div>
                        <div class="text-muted small ml-3">
                            <div>投稿日</div>
                            <div><strong>{{$incidentPost->created_at->diffForHumans()}}</strong></div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- 改行を反映して表示文字数を制限 -->
                    <p>{!! nl2br(htmlspecialchars(Str::limit($incidentPost->body,50,'.........'))) !!}</p>
                </div>
                <div class="card-footer d-flex flex-wrap justify-content-between align-items-center px-0 pt-0 pb-3">
                    <!-- コメントアイコンと数の表示 -->
                    <div class="px-4 pt-3">
                        @if ($incidentPost->comments->count())
                        <span class="badge badge-success">
                            <i class="fas fa-thin fa-comment pr-1">
                            {{$incidentPost->comments->count()}}
                            </i>
                        </span>
                    @else
                        <span class="badge badge-secondary">
                        <i class="fas fa-thin fa-comment pr-1">
                        0
                        </i>
                        </span>
                    @endif
                    <!-- いいね数とアイコンの表示 -->
                    @if($incidentPost->favorites->count())
                        <span class="badge badge-danger">
                            <i class="fas fa-thin fa-heart pr-1">
                            {{$incidentPost->favorites->count()}}
                            </i>
                        </span>
                    @else
                        <span class="badge badge-secondary">
                            <i class="fas fa-thin fa-heart pr-1"> 0 </i>
                        </span>
                    @endif
                    </div>

                    <div class="px-4 pt-3">
                        <button type="button" class="btn btn-primary">
                            <a href="{{route('incident-post.show', $incidentPost)}}" style="color:white;">コメントする</a>
                        </button> </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

<div class="d-flex justify-content-center ">
{{ $favorites->links() }}
</div>

@endif
@endsection
