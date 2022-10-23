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
