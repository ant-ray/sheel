<link rel="stylesheet" href="/css/adminTop.css">
@extends('layout')
@section('titel', '施設一覧')
@section('content')
    <div class=wrapper>
        <div class="menu">
            <!----検索窓------>
            <div class="search">
                <form action="{{ route('adminInstitutionListSearch') }}" method="post">
                    @csrf
                    <select class="searchBox" type="search" name="s_institution" placeholder="施設検索">
                        <option value="">入居施設を選択</option>
                        @foreach ($s_institutions as $s_institution)
                            <option value="{{ $s_institution->id }}">{{ $s_institution->name }}</option>
                        @endforeach
                    </select>
                    <input class="searchSend" type="submit" name="submit" value="検索">
                </form>
                <form action="{{ route('adminInstitutionListSearch') }}" method="post">
                    @csrf
                    <input class="searchSend" type="submit" name="submit" value="リセット">
                </form>
            </div>
            <div class="menu-b">
                <button class="institutionsList"
                    onclick="location.href='{{ route('institutionRegister') }}'">新規施設登録</button>
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
                <h1>施設一覧</h1>

                <!-- 施設コンテンツ -->
                <div class="search_result">
                    <div class="result_institution">
                        <p class="number">全{{ $institutions->total() }}件</p>
                        @foreach ($institutions as $institution)
                            @include('sheelAdmin.adminInstitutionContent', ['institution' => $institution])
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
