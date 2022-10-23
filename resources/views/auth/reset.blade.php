<link rel="stylesheet" href="/css/reset.css">
@extends('layout')
@section('titel', 'パスワードリセット')
@section('content')
    <div class=wrapper>
        <div class="content">
            <div class="loginBox">
                <h1>パスワードをリセットしましょう。</h1>
                <h2>あなたのメールアドレスを入力してください</h2>
                <h2>届いたメールのURLからリセット画面に進めます</h2>
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" style="color: green" :status="session('status')" />
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                <form action="{{ route('password.email') }}" method="POST">
                    @csrf
                    <div class="want">
                        <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                            placeholder="メールアドレス" />
                    </div>
                    <input class="send" type="submit" id="submit" value="送信">
                </form>
            </div>
        </div>
        <div class="back">
            <button class="backButton" onClick="history.back();">戻る</button>
        </div>
    </div>
@endsection
