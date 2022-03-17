@extends('layouts.app')

@section('content')

@if(session('message'))
<div class="alert alert-success">{{session('message')}}</div>
@endif

{{$user->name}}さんも投稿を共有しましょう！

<!-- 検索機能 -->
<div class=" d-flex justify-content-center ">
    <form class="form-inline my-2 my-lg-0 ml-2" style="height: 100px;" >
        <div class="form-group">
            <input type="search" class="form-control mr-sm-2" style="width: 350px; border-radius:70px;" name="search"  value="{{request('search')}}" placeholder="  キーワードを入力" aria-label="検索...">
        </div>
        <button type="submit" class="btn btn-info" style="border-radius:70px;">
            <span> 検索</span>
        </button>
    </form>
</div>

@foreach ($incidentPosts as $incidentPost)
<div class="container-fluid mt-20" style="margin-left:-10px;">
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <!-- ヘッダー -->
                <div class="card-header">
                <div class="media flex-wrap w-100 align-items-center">
                        <img src="{{asset('storage/avatar/'.($incidentPost->user->avatar??'user_default.jpg'))}}"
                        class="rounded-circle" style="width:40px;height:40px;">
                        <!-- タイトル -->
                        <div class="media-body ml-3">
                            <a href="{{route('incident-post.show', $incidentPost)}}">
                            {{ $incidentPost->title }}
                            </a>
                            <!-- ユーザー名 -->
                            <div class="text-muted small">
                                {{ $incidentPost->user->name }}
                            </div>
                        </div>
                        <div class="text-muted small ml-3">
                            <div>投稿日</div>
                            <div>
                                <strong>
                                {{$incidentPost->created_at->diffForHumans()}}
                                </strong>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- 内容 -->
                    <p>  {{ Str::limit ($incidentPost->body, 100, ' ...') }}   </p>
                </div>
                <div class="card-footer d-flex flex-wrap justify-content-between align-items-center px-0 pt-0 pb-3">
                    <div class="px-4 pt-3">
                        @if ($incidentPost->comments->count())
                        <span class="badge badge-success">
                            返信 {{$incidentPost->comments->count()}}件
                        </span>
                    @else
                        <span>コメントはまだありません。</span>
                    @endif
                    </div>
                    <div class="px-4 pt-3">
                        <button type="button" class="btn btn-primary">
                            <a href="{{route('incident-post.show', $incidentPost)}}" style="color:white;">
                            コメントする
                            </a>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection
