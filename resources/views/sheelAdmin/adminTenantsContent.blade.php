<link rel="stylesheet" href="/css/adminTenantContent.css">
<div class="wrapper">
    <div class="tenantContent">
        <button class="tenantName"
            onclick="location.href='{{ route('adminTenant') }}?id={{ $tenant['id'] }}'">{{ $tenant['name'] }}</button>
        <div class="emergency_contact">緊急連絡先{{ $tenant['emergency_contact'] }}<br>{{ $tenant['contact_name'] }}</div>
        <button class="backButton" onclick="location.href='{{ route('tenantUpdate') }}?id={{ $tenant['id'] }}'">編集</button>
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