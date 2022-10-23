<link rel="stylesheet" href="/css/adminLogin.css">
@extends('layout')
@section('titel', '管理者ログイン画面')
@section('content')
    <div class=wrapper>
        <div class="content">
            <div class="loginBox">
                <h1>管理者ログイン画面です</h1>
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" style="color: green" :status="session('status')" />
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                <form action="{{ route('adminLogin') }}" method="POST">
                    @csrf
                    <div class="want">
                        <input type="text" id="email" name="email" placeholder="メールアドレス">
                    </div>
                    <div class="want">
                        <input type="password" id="password" name="password" placeholder="パスワード">
                    </div>
                    <input class="send" type="submit" id="submit" value="入力完了">
                </form>
                <div class="nav">
                    <div class="new">
                        <button onclick="location.href='{{ route('adminRegister') }}'">新規登録</button>
                    </div>
                    <div class="reset">
                        <button onclick="location.href='{{ route('reset') }}'">パスワード<br>リセット</button>
                    </div>
                </div>
            </div>
            <button class="back" type="button" onclick="location.href='{{ route('login') }}'">一般ログインへ</button>
        </div>
    </div>
@endsection
