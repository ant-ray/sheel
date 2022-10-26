<link rel="stylesheet" href="/css/tenantRegister.css">
@extends('layout')
@section('titel', '編集')
@section('content')
    <div class=wrapper>
        <div class="content">
            <div class="registerBox">
                <h1>従業員ID:「{{ $user->id }}」「{{ $user->name }}」の情報編集</h1>
                

                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                <form action="{{ route('userUpdate') }}" method="POST">
                    @csrf
                    <div class="want">
                        <label for="name">
                            お名前:
                            <input id="name" class="block mt-1 w-full" type="text" name="name"
                                value={{ $user->name }} placeholder="山田太郎" />
                        </label>
                    </div>
                    <div class="want">
                        <label for="kana">
                            フリガナ:
                            <input id="kana" class="block mt-1 w-full" type="text" name="kana"
                                value={{ $user->kana }} placeholder="ヤマダタロウ" />
                        </label>
                    </div>
                    <div class="want">
                        <label for="email">
                            メールアドレス:<input id="email" class="block mt-1 w-full" type="email" name="email" value={{ $user->email }} placeholder="メールアドレス"/>
                        </label>
                    </div>
                    <div class="want">
                        <label for="tel">
                            緊急連絡先名:
                            <input id="tel" class="block mt-1 w-full" type="text"
                                name="tel" value={{ $user->tel }} placeholder="09012345678" />
                        </label>
                    </div>
                    <div class="want">
                        <label for="institution_id">
                            入居施設:
                            <div class="pull">
                                <select name="institution_id" id="institution_id" class="block mt-1 w-full"
                                    :value="old('institution_id')">
                                    <option value="{{ $institutionName->id }}">{{ $institutionName->name }}</option>
                                    @foreach ($institutions as $institution)
                                        <option value="{{ $institution->id }}">{{ $institution->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </label>
                    </div>
                    <input type="hidden" name="id" value="{{ $user->id }}">
                    <x-input class="send" type="submit" id="submit" value="登録" />
                </form>
            </div>
        </div>
        <div class="back">
            <button class="backButton" onClick="history.back();">戻る</button>
        </div>
    </div>
@endsection
