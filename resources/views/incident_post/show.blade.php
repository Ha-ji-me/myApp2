@extends('layouts.app')
@section('content')
<div class="card mb-4">
    <!-- カードヘッダー -->
    <div class="card-header">
        <img src="{{asset('storage/avatar/'.($incidentPost->user->avatar??'user_default.jpg'))}}"
        class="rounded-circle" style="width:40px;height:40px;">
        <div class="text-muted small mr-3">
            <!-- ユーザー名 -->
            {{$incidentPost->user->name ?? '削除されたユーザー'}}
        </div>
        <!-- タイトル -->
        <h4>{{$incidentPost->title}}</h4>
        <!-- 編集ページへ渡す処理 -->
        @can('update', $incidentPost)
        <span class="ml-auto">
            <a href="{{route('incident-post.edit',$incidentPost)}}"><button class="btn btn-primary">編集</button></a>
        </span>
        @endcan
        <!-- 削除ページへ渡す処理 -->
        @can('delete', $incidentPost)
        <span class="ml-2">
            <form method="post" action="{{route('incident-post.destroy',$incidentPost)}}">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger" onClick="return confirm('本当に削除しますか？');">削除</button>
            </form>
        </span>
        @endcan
    </div>
    <!-- カードボディ -->
    <div class="card-body">
        <p class="card-text">
            <!-- 記事内容 -->
            <!-- 新規投稿入力時の改行を反映させる -->
            <!-- $incidentPost->body -->
            {!! nl2br(htmlspecialchars($incidentPost->body)) !!}
        </p>
        <!-- 画像ファイル -->
        @if($incidentPost->image)
        <div>
            (画像ファイル：{{$incidentPost->image}})
        </div>
        <img src="{{asset('storage/images/'.$incidentPost->image)}}"
        class="img-fluid mx-auto d-block" style="height:300px;">
        @endif
    </div>
    <!-- カードフッター -->
    <div class="card-footer">
        <!-- お気に入り機能 -->
        <span>
        <!-- もし$favoriteがあれば（ユーザーがお気に入りにしていれば） -->
        @if($favorite)
            <a href="{{ route('unfavorite', $incidentPost) }}" class="btn btn-danger btn-sm">
                <!-- お気に入り数を表示 -->
                <span>
                    <i class="fas fa-thin fa-heart">
                    {{ $incidentPost->favorites->count() }}
                    </i>
                </span>
            </a>
        @else
        <!-- ユーザーがお気に入りにしていなければ、ボタン表示 -->
            <a href="{{ route('favorite', $incidentPost) }}" class="btn btn-secondary btn-sm">
                <span>
                    <i class="fas fa-thin fa-heart">
                    {{ $incidentPost->favorites->count() }}
                    </i>
                </span>
            </a>
        @endif
        </span>

        <span class="mr-2 float-right">
            <!-- 投稿日時 -->
            投稿日時 {{$incidentPost->created_at->diffForHumans()}}
        </span>
    </div>
</div>

<!-- コメント機能周り -->
<hr>
@if ($incidentPost->comments)
@foreach ($incidentPost->comments as $comment)
<div class="card mb-4">
    <div class="card-header">
        <img src="{{asset('storage/avatar/'.($comment->user->avatar??'user_default.jpg'))}}"
        class="rounded-circle" style="width:40px;height:40px;">
        <div class="text-muted small mr-3">
        {{$comment->user->name ?? '削除されたユーザー'}}
        </div>
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
@endif

<!-- バリデーションエラー表示 -->
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<!-- コメント投稿フォーム -->
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
