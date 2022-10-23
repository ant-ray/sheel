<link rel="stylesheet" href="/css/login.css">
@extends('layout')
@section('titel', 'ログイン画面')
@section('content')
    <div class=wrapper>
        <div class="content">
            <div class="loginBox">
                <h1>ログインしてください</h1>
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" style="color: green" :status="session('status')" />
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="want">
                        <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" placeholder="メールアドレス"/>
                    </div>
                    <div class="want">

                        <x-input id="password" class="block mt-1 w-full" type="password" name="password" placeholder="パスワード" autocomplete="current-password"/>
                    </div>
                    <input class="send" type="submit" id="submit" value="入力完了">
                </form>
                <div class="nav">
                    <div class="new">
                        <button type="register" onclick="location.href='{{ route('register') }}'">新規登録</button>
                    </div>
                    <div class="reset">
                        <button type="register" onclick="location.href='{{ route('reset') }}'">パスワード<br>リセット</button>
                    </div>
                </div>
            </div>
        </div>
        <button class="admin" type="button"
            onclick="location.href='{{ route('adminLogin') }}'">管理者としてログイン<br>される方はこちら</button>
    </div>
@endsection
