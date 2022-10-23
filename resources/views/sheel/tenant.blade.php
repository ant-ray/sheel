<link rel="stylesheet" href="/css/tenantDetail.css">
@extends('layout')
@section('titel', '利用者詳細画面')
@section('content')
    <div class=wrapper>
        @if (session('flash_message'))
            <div class="flash_message">
                {{ session('flash_message') }}
            </div>
        @endif
        <div class="content">
            <h1>{{ $tenant->name }}さんの詳細</h1>
            <div class="detailBox">
                <div class="upper">
                    <div class="name">{{ $tenant->name }}<br>{{ $tenant->kana }}</div>
                    <div class="tel">緊急連絡先<br>{{ $tenant->contact_name }}<br>{{ $tenant->emergency_contact }}</div>
                    <button class="creatCondition"
                        onclick="location.href='{{ route('conditionRegister') }}?id={{ $tenant->id }}'">体調記録</button>
                </div>
                <div class="under">
                    <div class="information">
                        <p>性別:『{{ $tenant->sex }}』</p>
                        <p>年齢:『{{ $tenant->age }}歳』</p>
                        <p>入居施設名:『{{ $institutionName->name }}』</p>
                    </div>
                    <div class="back">
                        <button class="backButton" onClick="location.href='{{ route('top') }}'">戻る</button>
                    </div>
                </div>
            </div>
            <div class="conditions">
                <div id="conditionsText">
                    <p>本日の体調:</p>
                    @isset($lastConditions)
                    <p>『{{ $lastConditions->condition }}』</p>
                    @else
                    <p>『未登録』</p>
                    @endisset   
                </div>
                <div class="conditionButtons">
                    <form id="good" action="/echo/json" method="get">
                        <input type="hidden" name="tenant_id" value="{{ $tenant->id }}">
                        <input type="hidden" name="body" value="とても良好です。">
                        <input type="hidden" name="condition" value="良い">
                        <button class="good" id="good">良い</button>
                    </form>
                    <form id="usually" action="/echo/json" method="get">
                        <input type="hidden" name="tenant_id" value="{{ $tenant->id }}">
                        <input type="hidden" name="body" value="健康です。">
                        <input type="hidden" name="condition" value="普通">
                        <button class="usually" id="usually">普通</button>
                    </form>
                    <button class="bad"
                        onclick="location.href='{{ route('conditionRegister') }}?id={{ $tenant->id }}'">悪い</button>
                </div>
            </div>
            <div class="search_result">
                <div class="result_condition">
                    <h1>これまでの体調</h1>
                    <p class="number">全{{ $conditions->total() }}件</p>
                    <!----検索窓------>
                    <div class="search">
                        <form action="{{ route('conditionSearch') }}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $tenant->id }}">
                            <input class="searchBox" type="date" name="s_Sdate">~<input class="searchBox" type="date"
                                name="s_Edate" value="<?php echo date('Y-m-d'); ?>">
                            <select class="searchBox" type="search" name="s_condition" placeholder="体調検索">
                                <option value="">体調を選択</option>
                                <option value="良い">良い</option>
                                <option value="普通">普通</option>
                                <option value="悪い">悪い</option>
                            </select>
                            <input class="searchSend" type="submit" name="submit" value="検索">
                        </form>
                        <form action="{{ route('conditionSearch') }}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $tenant->id }}">
                            <input class="searchSend" type="submit" name="submit" value="リセット">
                        </form>
                    </div>
                    <div class="conditionsBox">
                        @foreach ($conditions as $condition)
                            @include('sheel.condition', ['condition' => $condition])
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
