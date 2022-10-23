<link rel="stylesheet" href="/css/conditionRegister.css">
@extends('layout')
@section('titel', '体調登録画面')
@section('content')
    <div class=wrapper>
        <div class="content">
            <div class="registerBox">
                <h1>{{ $tenant->name }}さんの体調</h1>

                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                <form action="{{ route('conditionRegister') }}" method="POST">
                    @csrf
                    <div class="want">
                        <label for="condition">
                            体調:
                            <div class="radio">
                                <x-input id="condition" class="block mt-1 w-full" type="radio" name="condition"
                                    :value="'良い'" />良い
                                <x-input id="condition" class="block mt-1 w-full" type="radio" name="condition"
                                    :value="'普通'" />普通
                                <x-input id="condition" class="block mt-1 w-full" type="radio" name="condition"
                                    :value="'悪い'" checked/>悪い
                            </div>
                        </label>
                    </div>
                    <div class="want">
                        <label for="body">
                            体調詳細:
                            <textarea id="body" class="block mt-1 w-full" name="body" placeholder="昨日○○時ころから体調不良につき、お薬○○服用。"></textarea>
                        </label>
                    </div>
                    <input type="hidden" name="tenant_id" value="{{ $tenant->id }}">
                    <x-input class="send" type="submit" id="submit" value="登録" />
                </form>
            </div>
        </div>
        <div class="back">
            <button class="backButton" onClick="history.back();">戻る</button>
        </div>
    </div>
@endsection
