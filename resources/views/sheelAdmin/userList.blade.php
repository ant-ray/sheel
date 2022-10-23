<link rel="stylesheet" href="/css/adminTop.css">
@extends('layout')
@section('titel', '従業員一覧')
@section('content')
    <div class=wrapper>
        <div class="menu">
            <!----検索窓------>
            <div class="search">
                <form action="{{ route('userListSearch') }}" method="post">
                    @csrf
                    <input class="searchBox" type="search" name="search" value="{{ $search ?? '' }}" placeholder="お名前を入力">
                    <input class="searchSend" type="submit" name="submit" value="検索">
                </form>
                <form action="{{ route('userListSearch') }}" method="post">
                    @csrf
                    <input class="searchSend" type="submit" name="submit" value="リセット">
                </form>
            </div>
            <div class="menu-b">
                <button class="back" onclick="location.href='{{ route('adminTop') }}'">戻る</button>
            </div>
        </div>
        <!-- フラッシュメッセージ -->
        @if (session('flash_message'))
            <div class="flash_message">
                {{ session('flash_message') }}
            </div>
        @endif
        <div class="content">
            <div class="loginBox">
                <h1>従業員一覧</h1>

                <!-- 施設コンテンツ -->
                <div class="search_result">
                    <div class="result_user">
                        <p class="number">全{{ $users->total() }}件</p>
                        @foreach ($users as $user)
                        @include('sheelAdmin.userContent', ['user' => $user])
                        @endforeach
                    </div>

                </div>

            </div>
        </div>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <x-input class="send" type="submit" id="submit" value="ログアウト" />
        </form>
    </div>
@endsection
