@extends('layouts.app')
@section('content')

<div class="card mb-4">
    <div class="card-header">
        <div class="text-muted small mr-3">
            {{$incidentPost->user->name}}
        </div>
        <h4>{{$incidentPost->title}}</h4>
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

@endsection
