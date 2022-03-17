@extends('layouts.app')
@section('content')

@if(session('message'))
<div class="alert alert-success">{{session('message')}}</div>
@endif

<!-- <div class="ml-2 mb-3">
    home
</div> -->


<!-- <h4>{{$user->name}}さんも投稿を共有しましょう!!</h4> -->

<!-- 検索機能 -->
<div class=" d-flex justify-content-center ">
    <form class="form-inline my-2 my-lg-0 ml-2" style="height: 100px;" >
        <div class="form-group">
            <input type="search" class="form-control mr-sm-2" style="width: 350px; border-radius:70px;" name="search"  value="{{request('search')}}" placeholder="  キーワードを入力" aria-label="検索...">
        </div>
        <button type="submit" class="btn btn-info" style="border-radius:70px;">
            <i class="fas fa-search"><span> 検索</span></i>
        </button>
    </form>
</div>

@foreach ($incidentPosts as $incidentPost)
<div class="container-fluid mt-20" style="margin-left:-10px;">
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-3">
                <!-- header -->
                <div class="card-header">
                    <div class="media flex-wrap w-100 align-items-center">
                        <img src="{{asset('storage/avatar/'.($incidentPost->user->avatar??'user_default.jpg'))}}"
                        class="rounded-circle" style="width:40px;height:40px;">
                        <!-- タイトル -->
                        <div class="media-body ml-3 "><a href="{{route('incident-post.show',$incidentPost)}}" class="text-dark">{{$incidentPost->title}}</a>
                            <!-- ユーザー名 -->
                            <div class="text-muted small"> {{$incidentPost->user->name ?? '削除されたユーザー'}}</div>
                        </div>
                        <div class="text-muted small ml-3">
                            <div>投稿日</div>
                            <!-- 投稿日（最新順） -->
                            <div><strong> {{$incidentPost->created_at->diffForHumans()}} </strong> </div>
                        </div>
                    </div>
                </div>
                <!-- body -->
                <div class="card-body">
                    <!-- 記事内容 -->
                    <!-- 改行を反映して表示文字数を制限 -->
                    <!-- <p>  Str::limit$incidentPost->body,100,'...' </p> -->
                    <p> {!! nl2br(htmlspecialchars(Str::limit($incidentPost->body,100,'.........'))) !!}</p>
                </div>
                <!-- footer -->
                <div class="card-footer d-flex flex-wrap justify-content-between align-items-center px-0 pt-0 pb-3">
                    <div class="px-4 pt-3">
                    <!-- コメント数とアイコンの表示 -->
                        @if($incidentPost->comments->count())
                        <span class="badge badge-success">
                            <!-- fontAwesomeでコメントアイコン -->
                            <i class="fas fa-thin fa-comment pr-1">
                            {{$incidentPost->comments->count()}}
                            </i>
                        </span>
                        @else
                        <span class="badge badge-secondary">
                            <i class="fas fa-thin fa-comment pr-1"> 0 </i>
                        </span>
                        @endif
                    <!-- いいね数とアイコンの表示 -->
                        @if($incidentPost->favorites->count())
                        <span class="badge badge-danger">
                            <i class="fas fa-thin fa-heart">
                            {{$incidentPost->favorites->count()}}
                            </i>
                        </span>
                        @else
                        <span class="badge badge-secondary">
                            <i class="fas fa-thin fa-heart"> 0 </i>
                        </span>
                        @endif
                    </div>
                    <div class="px-4 pt-3">
                        <button type="button" class="btn btn-primary">
                            <a href="{{route('incident-post.show',$incidentPost)}}" style="color:white;">詳細を見る</a>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

<div class="d-flex justify-content-center ">
    {{ $incidentPosts->links() }}
</div>

@endsection
