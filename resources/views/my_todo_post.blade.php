@extends('layouts.app')
@section('content')

@if(session('message'))
<div class="alert alert-success">{{session('message')}}</div>
@endif

<div class="ml-2 mb-3">
    <h2 style="text-align:center">
        {{ $user->name }}さんのTodo
    </h2>
</div>

@if (count($todoPosts) == 0)
<h4 style="text-align: center;">
＊あなたはまだ投稿していません
</h4>
@else
@foreach ($todoPosts as $todoPost)
<div class="container-fluid mt-20" style="margin-left:-10px;">
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <div class="media flex-wrap w-100 align-items-center">
                        <img src="{{asset('storage/avatar/'.($todoPost->user->avatar??'user_default.jpg'))}}"
                        class="rounded-circle" style="width:40px;height:40px;">
                        <div class="media-body ml-3">
                            <a href="{{route('incident-post.show', $todoPost)}}" class="text-dark">
                                {{$todoPost->title}}
                            </a>
                            <div class="text-muted small">{{$todoPost->user->name ?? '削除されたユーザー'}}</div>
                        </div>
                        <div class="text-muted small ml-3">
                            <div>投稿日</div>
                            <div><strong>{{$todoPost->created_at->diffForHumans()}}</strong></div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- 改行を反映して表示文字数を制限 -->
                    <p>{!! nl2br(htmlspecialchars(Str::limit($todoPost->body,100,'.........'))) !!}</p>
                </div>
                <div class="card-footer d-flex flex-wrap justify-content-between align-items-center px-0 pt-0 pb-3">
                    <div class="px-4 pt-3">
                        {{-- <button type="button" class="btn btn-primary">
                            <a href="{{route('incident-post.show', $todoPost)}}" style="color:white;">詳細を見る</a>
                        </button> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

<div class="d-flex justify-content-center ">
{{ $todoPosts->links() }}
</div>

@endif
@endsection
