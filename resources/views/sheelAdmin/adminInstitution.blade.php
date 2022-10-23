<link rel="stylesheet" href="/css/detail.css">
@extends('layout')
@section('titel', '施設詳細画面')
@section('content')
    <div class=wrapper>
        <div class="content">
            <div class="detailBox">
                <h1>{{ $institution->name }}の詳細</h1>
                <div class="upper">
                    <div class="name">{{ $institution->name }}</div>
                    <div class="tel">{{ $institution->tel }}</div>
                    <div class="delete">
                        <script type="text/javascript">
                            function disp(){
                                // 「OK」時の処理開始 ＋ 確認ダイアログの表示
                                if(window.confirm('本当に実行しますか？')){
                                    location.href='{{ route('institutionDelete') }}?id={{ $institution->id }}'
                                }
                            }
                            </script>
                        <button class="backButton" onclick="disp()">削除</button>
                    </div>
                </div>
                <div class="under">
                    <div class="information">
                        <p>施設住所:『{{ $institution->address }}』</p>
                        <p>メールアドレス:『{{ $institution->email }}』</p>
                    </div>
                    <div class="back">
                        <button class="backButton" onClick="history.back();">戻る</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
