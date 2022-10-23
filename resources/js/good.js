jQuery(function good($) {
    $('#good').submit(function (event) {
        // HTMLでの送信をキャンセル
        event.preventDefault();

        // 操作対象のフォーム要素を取得
        var $form = $(this);

        // 送信ボタンを取得
        // （後で使う: 二重送信を防止する。）
        var $button = $form.find('button');

        // 送信
        $.ajax({
            url: 'ajaxConditionRegister',
            type: $form.attr('method'),
            data: $form.serialize(),
            timeout: 30000,  // 単位はミリ秒

            // 送信前
            beforeSend: function () {
                // ボタンを無効化し、二重送信を防止
                $button.attr('disabled', true);
            },
            // 応答後
            complete: function () {
                // ボタンを有効化し、再送信を許可
                $button.attr('disabled', false);
            },

            // 通信成功時の処理
            success: function () {
                $("#good").css("background", '#e599c3');
                $(".good").css("background", '#e599c3');
                $("#good").css("box-shadow", "0 0 15px 15px #e599c3");
                $(".good").css("box-shadow", "0 0 15px 15px #e599c3");
                $(".good").css("border-color", "#e599c3");
                $("#usually").css("background", '#BDDFC2');
                $("#usually").css("box-shadow", "0 0 15px 15px #BDDFC2");
                $("#usually").css("border-color", "#F7C3AB");
                var conditionsText_element = document.getElementById('conditionsText');
                var remove_element = conditionsText_element.removeChild(conditionsText_element.lastElementChild);//削除
                console.log(remove_element.textContent);
                var new_element = document.createElement('p');
                new_element.textContent = '『良い』';
                conditionsText_element.appendChild(new_element);
            },

            // 通信失敗時の処理
            error: function () { }
        });
    });
});

