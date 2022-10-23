<link rel="stylesheet" href="/css/adminTenantDetail.css">
@extends('layout')
@section('titel', '利用者詳細画面')
@section('content')
    <div class=wrapper>
        <div class="content">
            <div class="detailBox">
                <h1>{{ $tenant->name }}さんの詳細</h1>
                <div class="upper">
                    <div class="name">{{ $tenant->name }}<br>{{ $tenant->kana }}</div>
                    <div class="tel">緊急連絡先<br>{{ $tenant->contact_name }}<br>{{ $tenant->emergency_contact }}</div>
                    <div class="delete">
                        <script type="text/javascript">
                            function disp(){
                                // 「OK」時の処理開始 ＋ 確認ダイアログの表示
                                if(window.confirm('本当に実行しますか？')){
                                    location.href='{{ route('tenantDelete') }}?id={{ $tenant->id }}'
                                }
                            }
                            </script>
                        <button class="backButton" onclick="disp()">削除</button>
                    </div>
                </div>
                <div class="under">
                    <div class="information">
                        <p>性別:『{{ $tenant->sex }}』</p>
                        <p>年齢:『{{ $tenant->age }}歳』</p>
                        <p>入居施設名:『{{ $institutionName->name }}』</p>
                    </div>
                    <div class="back">
                        <button class="backButton" onClick="location.href='{{ route('tenantUpdate') }}?id={{ $tenant->id }}'">編集</button>
                        <button class="backButton" onClick="location.href='{{ route('adminTop') }}'">戻る</button>
                    </div>
                </div>
            </div>
            <div class="search_result">
                <div class="result_condition">
                    <h1>これまでの体調</h1>
                    <p class="number">全{{ $conditions->total() }}件</p>
                    <!----検索窓------>
                    <div class="search">
                        <form action="{{ route('adminConditionSearch') }}" method="post">
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
                        <form action="{{ route('adminConditionSearch') }}" method="post">
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
