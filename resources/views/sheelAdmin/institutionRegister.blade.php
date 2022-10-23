<link rel="stylesheet" href="/css/register.css">
@extends('layout')
@section('titel', '新規施設画面')
@section('content')
<div class=wrapper>
    <div class="content">
        <div class="registerBox">
            <h1>新規施設登録</h1>

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <form action="{{ route('institutionRegister') }}" method="POST">
                @csrf
                <div class="want">
                    <label for="name">
                        施設名:<x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" placeholder="ケアホーム松葉"/>
                    </label>
                </div>
                <div class="want">
                    <label for="address">
                        住所:<x-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" placeholder="〇〇県〇〇市〇〇町X-X-X"/>
                    </label>
                </div>
                <div class="want">
                    <label for="tel">
                        電話番号:<x-input id="tel" class="block mt-1 w-full" type="tel" name="tel" :value="old('tel')" placeholder="09012345678"/>
                    </label>
                </div>
                <div class="want">
                    <label for="email">
                        メールアドレス:<x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" placeholder="メールアドレス"/>
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