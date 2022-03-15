@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-md-10 mt-6">
        <div class="card-body">
            <h2 class="mt4" style="text-align:center">出来事の新規投稿</h2>
            <!-- {{--エラーメッセージ--}} -->
            @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                    @if(empty($errors->first('image')))
                    <li>画像ファイルがあれば、再度、選択してください。</li>
                    @endif
                </ul>
            </div>
            @endif
            @if(session('message'))
            <div class="alert alert-success">{{session('message')}}</div>
            @endif
            <form method="post" action="{{route('incident-post.store')}}" enctype="multipart/form-data">
            @csrf
            <!-- {{--各項目はold関数で値を残したままエラーを吐きます--}} -->
                <div class="form-group">
                    <label for="title">タイトル</label>
                    <input type="text" name="title" class="form-control" id="title" value="{{old('title')}}" placeholder="ex)) JavaScriptで発生したエラーについて">
                </div>

                <div class="form-group">
                    <label for="body">内容</label>
                    <textarea name="body" class="form-control" id="body" cols="30" rows="10" placeholder="ex))&#13;&#10;関数について勉強しているところですが、関数を呼び出すときに以下のようなエラーが出てしまいます。&#13;&#10;このエラーについて何かわかる方がいましたらコメント頂けると幸いです。&#13;&#10;＊必要な場合は「ファイルを選択」からエラー詳細画像を添付してください。">{{old('body')}}</textarea>
                </div>

                <div class="form-group">
                    <label for="image"> ＊添付画像の選択（1MBまで） </label>
                    <div class="col-md-6">
                        <input id="image" type="file" name="image">
                    </div>
                </div>

                <button type="submit" class="btn btn-success">送信する </button>
            </form>
        </div>
    </div>
</div>

@endsection
