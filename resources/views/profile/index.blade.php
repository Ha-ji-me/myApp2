@extends('layouts.app')
@section('content')

<div class="ml-2 mb-3">
    <h2 style="text-align:center">ユーザーアカウント一覧<h2>
</div>

@if(session('message'))
<div class="alert alert-success">{{session('message')}}</div>
@endif

<table class="table" style="background-color:white;">
    <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">名前</th>
            <th scope="col">email</th>
            <th scope="col">avatar</th>
            <th scope="col">編集</th>
            <th scope="col">削除</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <th scope="row">{{$user->id}}</th>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <!-- アバター表示 -->
            <td>
                <!-- <img src="{{asset('storage/avatar/'.($user->avatar??'user_default.jpg'))}}"
                class="rounded-circle" style="width:40px;height:40px;"> -->
                <!-- cloudinary用 -->
                @if ($user->avatar === 'user_default.jpg')
                    <img src="https://res.cloudinary.com/dvk1j662j/image/upload/v1648786106/user_default_nu4dfv.jpg"
                        class="rounded-circle" style="width:40px;height:40px;">
                @else
                    <img src="{{ $user->avatar }}"
                        class="rounded-circle" style="width:40px;height:40px;">
                @endif

            </td>
            <!-- 編集ボタン -->
            <td>
                <a href="{{route('profile.edit', $user->id)}}">
                    <button class="btn btn-primary">
                        編集
                    </button>
                </a>
            </td>
            <!-- 削除ボタン -->
            <td>
                <form method="post" action="{{route('profile.delete', $user)}}">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger" onClick="return confirm('本当に削除しますか？');">
                        削除
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
