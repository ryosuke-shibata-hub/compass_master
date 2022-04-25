document.addEventListener('DOMContentLoaded', function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'ja',
            height: 'auto',
            firstDay: 1,
            headerToolbar: {
                left: "dayGridMonth,listMonth",
                center: "title",
                right: "today prev,next"
            },
            buttonText: {
                today: '今月',
                month: '月',
                list: 'リスト'
            },
            selectable: true,
            // selectHelper: true,
            select: function (start,end,allDay) {
        //alert("selected " + info.startStr + " to " + info.endStr);
        // 入力ダイアログ
                var title = prompt('イベントを入力してください');

                if (title) {


                    $.ajax({
                        url: "/my_schedule/store",
                        type: "POST",
                        data: {
                            title: title,
                            // start: start,
                            // end: end,
                            // type: 'add',
                        },
                        success:function (data) {
                            calendar.FullCalendar('refechEvents');
                            alert('ok');
                        }
                    });
                }



    },
            noEventsContent: 'スケジュールはありません',
         });
         calendar.render();
    });
