<link rel="stylesheet" href="/css/adminTop.css">
@extends('layout')
@section('titel', '管理者TOP')
@section('content')
    <div class=wrapper>
        <div class="menu">
            <!----検索窓------>
            <div class="search">
                <form action="{{ route('adminTopSearch') }}" method="post">
                    @csrf
                    <input class="searchBox" type="search" name="s_name" value="{{ $s_name ?? '' }}" placeholder="お名前を入力">
                    <select class="searchBox" type="search" name="s_institution" placeholder="施設検索">
                        @isset($s_institution)
                            <option value="{{ $s_institution->id }}">{{ $s_institution->name }}</option>
                            @foreach ($institutions as $institution)
                                <option value="{{ $institution->id }}">{{ $institution->name }}</option>
                            @endforeach
                        @else
                            <option value="">入居施設を選択</option>
                            @foreach ($institutions as $institution)
                                <option value="{{ $institution->id }}">{{ $institution->name }}</option>
                            @endforeach
                        @endisset
                    </select>
                    <input class="searchSend" type="submit" name="submit" value="検索">
                </form>
                <form action="{{ route('adminTopSearch') }}" method="post">
                    @csrf
                    <input class="searchSend" type="submit" name="submit" value="リセット">
                </form>
            </div>
            <div class="menu-b">
                <button class="institutionsList"
                    onclick="location.href='{{ route('adminInstitutionList') }}'">施設情報一覧</button>
                <button class="usersList" onclick="location.href='{{ route('userList') }}'">従業員一覧</button>
                <button class="creatTenant" onclick="location.href='{{ route('adminTenantRegister') }}'">新規利用者追加</button>
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
                <h1>入居者一覧</h1>
                <!-- 施設コンテンツ -->
                <div class="search_result">
                    <div class="result_tenant">
                        <p class="number">全{{ $tenants->total() }}件</p>
                        @foreach ($tenants as $tenant)
                            @include('sheelAdmin.adminTenantsContent', ['tenant' => $tenant])
                        @endforeach
                    </div>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <x-input class="send" type="submit" id="submit" value="ログアウト" />
            </form>
        </div>
    </div>
@endsection
