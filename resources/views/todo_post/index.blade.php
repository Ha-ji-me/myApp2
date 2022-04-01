@extends('layouts.app')
@section('content')

<h2 class="mt4" style="text-align:center">みんなのTodo</h2>

@if(session('message'))
<div class="alert alert-success">{{session('message')}}</div>
@endif

@foreach ($todoPosts as $todoPost)
<div class="container-fluid mt-20" style="margin-left:-10px;">
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <div class="media flex-wrap w-100 align-items-center">
                        <!-- アバター -->
                        <!-- 通常の記述 -->
                        <!-- <img src="{{asset('storage/avatar/'.($todoPost->user->avatar ?? 'user_default.jpg'))}}"
                        class="rounded-circle" style="width:40px;height:40px;"> -->
                        <!-- Cloudinary用の記述 -->
                        @if ($todoPost->user->avatar === 'user_default.jpg')
                            <img src="https://res.cloudinary.com/dvk1j662j/image/upload/v1648786106/user_default_nu4dfv.jpg"
                                class="rounded-circle" style="width:40px;height:40px;">
                        @else
                            <img src="{{ $todoPost->user->avatar }}"
                                class="rounded-circle" style="width:40px;height:40px;">
                        @endif
                        <!-- タイトル -->
                        <div class="media-body ml-3">
                            {{-- <a href="{{route('todo-post.create',$todoPost)}}"> --}}
                            <h6>
                                {{$todoPost->title}}
                            </h6>
                            <!-- ユーザー名 -->
                            <div class="text-muted small"> {{$todoPost->user->name ?? '削除されたユーザー'}}</div>
                        </div>
                        <div class="text-muted small ml-3">
                            <div>投稿日</div>
                            <!-- 投稿日（最新順） -->
                            <div><strong> {{$todoPost->created_at->diffForHumans()}} </strong> </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- 記事内容 -->
                    <!-- 改行を反映して表示文字数を制限 -->
                    <!-- <p>  Str::limit$incidentPost->body,100,'...' </p> -->
                    <p> {!! nl2br(htmlspecialchars($todoPost->body)) !!}</p>
                </div>
                <!-- カードフッター -->
                <div class="card-footer d-flex flex-wrap justify-content-between align-items-center px-0 pt-0 pb-3">
                    <div class="px-4 pt-3">

                    </div>
                    <!-- <div class="px-4 pt-3">
                        <button type="button" class="btn btn-primary">
                            <a href="{{route('todo-post.create',$todoPost)}}" style="color:white;">詳細を見る</a>
                        </button>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

<div class="d-flex justify-content-center ">
    {{ $todoPosts->links() }}
</div>

@endsection
