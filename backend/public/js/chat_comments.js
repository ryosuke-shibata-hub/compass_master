// $(function () {
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

        let appendText;
        let login = $('input[name="login"]').val();
        console.log(data);
        if (data.send === login) {
            appendText = '<div class="send"><p class="chat-date"> ' + data.created_at + '</p><div class="send-box"><pre class="pre-chat">' + data.comment + '</pre></div > </div>';
        } else if (data.recieve === login) {
             appendText = '<div class="recieve"><p class="chat-date"> ' + data.created_at + '</p><div class="recieve-box"><pre class="pre-chat">' + data.comment + '</pre></div ></div>';
        } else {
            return false;
        }
        console.log(10);
        // メッセージを表示
        $("#room").append(appendText);
        console.log(appendText);
        if (data.recieve === login) {
            // ブラウザへプッシュ通知
            Push.create("新着メッセージ",
                {
                    body: data.comment,
                    timeout: 8000,
                    onClick: function () {
                        window.focus();
                        this.close();
                    }
                })
        }
    });

    $.ajaxSetup({
            headers : {
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content'),
            }});
        // メッセージ送信
    // $('#btn_send').on('click', function () {
    $('#btn_send').on('click', function () {
        $.ajax({
            headers : {
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content'),
            },
            type : 'POST',
            url : '/chat/send',
            data: {
                comment : $('textarea[name="comment"]').val(),
                send : $('input[name="send"]').val(),
                recieve: $('input[name="recieve"]').val(),
                created_at : $('input[name="date"]').val(),
        },
        }).done(function(result){
            $('textarea[name="comment"]').val('');
        }).fail(function(result){

        });
    });
// });
