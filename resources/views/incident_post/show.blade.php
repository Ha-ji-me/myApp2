@extends('layouts.app')
@section('content')

<div class="card mb-4">
    <div class="card-header">
        <div class="text-muted small mr-3">
            {{$incidentPost->user->name}}
        </div>
        <h4>{{$incidentPost->title}}</h4>
        <span class="ml-auto">
        <a href="{{route('incident-post.edit', $incidentPost)}}"><button class="btn btn-primary">編集</button></a>
        </span>
        <span class="ml-2">
            <form method="post" action="{{route('incident-post.destroy', $incidentPost)}}">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger" onClick="return confirm('本当に削除しますか？');">削除</button>
            </form>
        </span>
    </div>
    <div class="card-body">
        <p class="card-text">
            {{$incidentPost->body}}
        </p>
        @if ($incidentPost->image)
        <div>
            (画像ファイル：{{$incidentPost->image}})
        </div>
        <img src="{{asset('storage/images/'.$incidentPost->image)}}"
        class="img-fluid mx-auto d-block" style="height:300px;">
        @endif
    </div>
    <div class="card-footer">
        <span class="mr-2 float-right">
            投稿日時 {{$incidentPost->created_at->diffForHumans()}}
        </span>
    </div>
</div>

<hr>
@foreach ($incidentPost->comments as $comment)
<div class="card mb-4">

    <div class="card-header">
        {{$comment->user->name}}
    </div>
    <div class="card-body">
        {{$comment->body}}
    </div>
    <div class="card-footer">
        <span class="mr-2 float-right">
            投稿日時 {{$comment->created_at->diffForHumans()}}
        </span>
    </div>
</div>
@endforeach

<!-- バリデーションエラーの表示 -->
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<!-- コメントフォーム -->
<div class="card mb-4">
    <form method="post" action="{{route('comment.store')}}">
        @csrf
        <input type="hidden" name='incident_post_id' value="{{$incidentPost->id}}">
        <div class="form-group">
            <textarea name="body" class="form-control" id="body" cols="30" rows="5"
            placeholder="コメントを入力する">{{old('body')}}</textarea>
        </div>
        <div class="form-group">
        <button class="btn btn-success float-right mb-3 mr-3">コメントする</button>
        </div>
    </form>
</div>

@endsection
