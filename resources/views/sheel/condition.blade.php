<div class="wrapper">
    <div class="conditionContent">
        <div class="infor">
            <div class="created_at">
                記録日:{{ $condition->created_at }}<br>
                記録者:{{ $condition->name }}
            </div>
            <div class="condition">
                <p>体調:『{{ $condition->condition }}』</p>
            </div>
        </div>
        <div class="body">
            体調詳細:{{ $condition->body }}
        </div>
    </div>
</div>
