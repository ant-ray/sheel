<link rel="stylesheet" href="/css/userContent.css">
<div class="wrapper">
    <div class="userContent">
        <button class="userName" onclick="location.href='{{ route('user') }}?id={{ $user['id'] }}'">{{ $user['name'] }}</button>
        <div class="tel">連絡先<br>{{ $user['tel'] }}</div>
        <div class="delete">
            <script type="text/javascript">
                function disp() {
                    if (window.confirm('本当に実行しますか？')) {
                        location.href = '{{ route('userDelete') }}?id={{ $user['id'] }}'
                    }
                }
            </script>
            <button class="backButton" onclick="location.href='{{ route('user') }}?id={{ $user['id'] }}'">編集</button>
            <button class="backButton" onclick="disp()">削除</button>
        </div>
    </div>
</div>
