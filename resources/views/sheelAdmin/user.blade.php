<link rel="stylesheet" href="/css/Detail.css">
@extends('layout')
@section('titel', '従業員詳細画面')
@section('content')
    <div class=wrapper>
        <div class="content">
            <div class="detailBox">
                <h1>{{ $user->name }}さんの詳細</h1>
                <div class="upper">
                    <div class="name">{{ $user->name }}<br>{{ $user->kana }}</div>
                    <div class="tel">連絡先{{ $user->tel }}</div>
                    <div class="delete">
                        <script type="text/javascript">
                            function disp(){
                                // 「OK」時の処理開始 ＋ 確認ダイアログの表示
                                if(window.confirm('本当に実行しますか？')){
                                    location.href='{{ route('userDelete') }}?id={{ $user->id }}'
                                }
                            }
                            </script>
                        <button class="backButton" onclick="disp()">削除</button>
                    </div>
                </div>
                <div class="under">
                    <div class="information">
                        <p>従業員ID: 『{{ $user->id }}』</p>
                        <p>メールアドレス:『{{ $user->email }}』</p>
                        <!--- もし管理者だった場合は管理者を返す ---->
                            <p>就労施設名:『{{ $institutionName->name }}』</p>
                    </div>
                    <div class="back">
                        <button class="backButton" onClick="history.back();">戻る</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
