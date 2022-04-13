    //ログを有効にする
    Pusher.logToConsole = true;

    var pusher = new Pusher('b01930fa17761ba38f1c', {
        cluster: 'ap3',
        encrypted: true
    });
    //購読するチャンネルを指定
    var pusherChannel = pusher.subscribe('chat');
    //イベントを受信したら、下記処理
    pusherChannel.bind('chat_event', function (data) {
        console.log(1);
        alert(1);
        let appendText;
        let login = $('input[name="login"]').val();

        if (data.send === login) {
            appendText = '<div class="send" style="text-align:right"><p>' + data.comment + '</p></div> ';
        } else if (data.recieve === login) {
            appendText = '<div class="recieve" style="text-align:left"><p>' + data.comment + '</p></div> ';
        } else {
            return false;
        }
        console.log(10);
        // メッセージを表示
        $("#room").append(appendText);
        console.log(appendText);
        // if (data.recieve === login) {
        //     // ブラウザへプッシュ通知
        //     Push.create("新着メッセージ",
        //         {
        //             body: data.message,
        //             timeout: 8000,
        //             onClick: function () {
        //                 window.focus();
        //                 this.close();
        //             }
        //         })

        // }


    });

    // メッセージ送信
    $('#btn_send').on('click', function () {
        var comment = $('textarea[name="comment"]').val();
        var send = $('input[name="send"]').val();
        var recieve = $('input[name="recieve"]').val();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            type: 'POST',
            url: '/chat/send',
            data: {
                comment : $('textarea[name="comment"]').val(),
                send : $('input[name="send"]').val(),
                recieve : $('input[name="recieve"]').val(),
            },
        })
        .done(function (result) {
            $('textarea[name="comment"]').val('');
        }).fail(function (result) {

        });
    });
