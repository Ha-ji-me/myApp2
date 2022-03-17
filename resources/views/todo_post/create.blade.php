@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-md-10 mt-6">
        <div class="card-body">
            <h2 class="mt4" style="text-align:center">Todoの新規投稿</h2>
            <!-- {{--エラーメッセージ--}} -->
            @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @if(session('message'))
            <div class="alert alert-success">{{session('message')}}</div>
            @endif

            <form method="post" action="{{route('todo-post.store')}}" enctype="multipart/form-data">
            @csrf
            <!-- {{--各項目はold関数で値を残したままエラーを吐きます--}} -->
                <div class="form-group">
                    <label for="title">タイトル</label>
                    <input type="text" name="title" class="form-control" id="title" value="{{old('title')}}" placeholder="ex)) JavaScript基礎構文">
                </div>

                <div class="form-group">
                    <label for="body">Todoの内容</label>
                    <textarea name="body" class="form-control" id="body" cols="30" rows="10" placeholder="ex))&#13;&#10;・条件分岐&#13;&#10;if文について理解する&#13;&#10;・繰り返し文&#13;&#10;for文について理解する&#13;&#10;">{{old('body')}}</textarea>
                </div>

                <button type="submit" class="btn btn-success">投稿する </button>
            </form>
        </div>
    </div>
</div>

@endsection
