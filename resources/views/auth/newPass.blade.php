<link rel="stylesheet" href="/css/newPass.css">
@extends('layout')
@section('titel', 'パスワードリセット')
@section('content')
    <div class=wrapper>
        <div class="content">
            <div class="registerBox">
                <h1>パスワードを再度入力してください。</h1>
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                <form action="{{ route('password.update') }}" method="POST">
                    @csrf
                    <!-- Password Reset Token -->
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">
                    <div class="want">
                        <label for="email">
                            メールアドレス:
                            <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                                :value="old('email', $request->email)" placeholder="メールアドレス"/>
                        </label>
                    </div>
                    <div class="want">
                        <label for="password">
                            新しいパスワード:
                            <x-input id="password" class="block mt-1 w-full" type="password" name="password"
                                placeholder="パスワード"/>
                        </label>
                    </div>
                    <div class="want">
                        <label for="password_confirmation">
                            確認用（もう一度）:
                            <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                                name="password_confirmation" placeholder="パスワード"/>
                        </label>
                    </div>
                    <input class="send" type="submit" id="submit" value="登録">
                </form>
            </div>
        </div>
    </div>
@endsection
