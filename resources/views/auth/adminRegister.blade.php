<link rel="stylesheet" href="/css/register.css">
@extends('layout')
@section('titel', '新規登録画面')
@section('content')
<div class=wrapper>
    <div class="content">
        <div class="registerBox">
            <h1>管理者新規登録</h1>

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <form action="{{ route('adminRegister') }}" method="POST">
                @csrf
                <div class="want">
                    <label for="name">
                        お名前:<x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" placeholder="山田太郎"/>
                    </label>
                </div>
                <div class="want">
                    <label for="kana">
                        フリガナ:<x-input id="kana" class="block mt-1 w-full" type="text" name="kana" :value="old('kana')" placeholder="ヤマダタロウ"/>
                    </label>
                </div>
                <div class="want">
                    <label for="tel">
                        電話番号:<x-input id="tel" class="block mt-1 w-full" type="text" name="tel" :value="old('tel')" placeholder="09012345678"/>
                    </label>
                </div>
                <div class="want">
                    <label for="email">
                        メールアドレス:<x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" placeholder="メールアドレス"/>
                    </label>
                </div>
                <div class="want">
                    <label for="password">
                        パスワード:<x-input id="password" class="block mt-1 w-full" type="password" name="password" placeholder="半角英数字8文字以上"/>
                    </label>
                </div>
                <div class="want">
                    <label for="password_confirmation">
                        パスワード:<x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" placeholder="確認用"/>
                    </label>
                </div>
                <div class="want">
                    <label for="role">
                        管理コード:<x-input type="password" id="role" name="role" placeholder="管理者用コード" />
                    </label>
                </div>
                <x-input class="send" type="submit" id="submit" value="登録"/>
            </form>
        </div>
    </div>
    <div class="back">
        <button class="backButton" onClick="history.back();">戻る</button>
    </div>
</div>
@endsection