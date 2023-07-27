import { Calendar } from "@fullcalendar/core";
import interactionPlugin from "@fullcalendar/interaction";
import dayGridPlugin from "@fullcalendar/daygrid";

var calendarEl = document.getElementById("calendar");
let i = 0;

let calendar = new Calendar(calendarEl, {
  plugins: [interactionPlugin, dayGridPlugin],
  initialView: "dayGridMonth",
  headerToolbar: {
      left: "prev,next today",
      center: "title",
      right: "",
  },
  // events: param,
  locale: "ja",
  // height: 800,
  contentHeight: "auto",
  dayMaxEvents: true,
  // if(){
  // eventColor: '#378006'
  // }

  
  

  // 日付をクリック、または範囲を選択したイベント
  selectable: true,
  select: function (info) {//イベントの登録
    // alert("selected " + info.startStr + " to " + info.endStr);
      // 入力ダイアログ
      const eventName = prompt("イベントを入力してください");
    
      if (eventName) {
      const eventData = {
        title: eventName,
        start: info.startStr,
        end: info.endStr,
        // id: i++,
        // color: 'red'

        // allDay: true,
      };
  
      
  
      // サーバーにデータをPOST通信で送信
      postDataToServer(eventData);

      console.log("kaettekita")
      // イベントを追加
      
      // calendar.addEvent(data);
      console.log("追加できない")
      // console.log(data)

    }
  }, 
  
  events: function (info, successCallback, failureCallback) {//一覧表示
    console.log("明日がある");
    fetch("/schedule-get", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        'X-CSRF-TOKEN': csrfToken // CSRFトークンをヘッダーに追加

      },
      body: JSON.stringify({
        start_date: info.start.valueOf(),
        end_date: info.end.valueOf(),
      }),
      
    })
    .then(response => response.json()) // 返ってきたレスポンスをjsonで受け取って次のthenへ渡す
    // .then(res => {
    //   console.log("通信成功");
    //   console.log(res ); // 返ってきたデータ
    // })
    .then(data => {
      // データをFullCalendarのイベント形式に変換してカレンダーに追加
      const eventsFromDB = data.map(item => ({
        title: item.title,
        id: item.schedule_id,
        start: item.start,
        end: item.end,
        color: 'red'
        
      }));

      // 静的なイベントデータ（param変数）をFullCalendarの形式に変換
      const staticEvents = param.map(item => ({
        title: item.title,
        start: item.start,
        end: item.end,
        color: 'blue',
        editable: false
      }));

      // 静的なイベントデータとデータベースから取得したイベントデータを結合
      const allEvents = [...staticEvents, ...eventsFromDB];

      // FullCalendarにイベントデータを追加して表示
      successCallback(allEvents);
    })
  
    .catch(error => {
        console.log(error); // エラー表示
    })
  },

  eventClick: function(arg) {//イベントのクリック＆削除
      console.log(arg);
      const eventId = arg.event._def.publicId;

      // typeof eventId

      if(eventId) {
        // 変数aが存在する時の処理
        console.log(eventId)
        if (confirm('削除しますか？')) {
          arg.event.remove()
      
        fetch(`/schedule_dell/${eventId}`,{
        })
    
        .then(response => response.json()) // 返ってきたレスポンスをjsonで受け取って次のthenへ渡す
          .then(res => {
            console.log("通信成功");
            console.log(res); // 返ってきたデータ
          })
    
          .catch(error => {
              console.log(error); // エラー表示
          })
        }
      } else {
        alert("googleでの予定です")
    }
  },

  eventHover: function(arg) {
    // カーソルを指の形に変更
    arg.el.style.cursor = 'pointer';
  },
  eventMouseout: function(arg) {
    // カーソルを元のカーソルに戻す
    arg.el.style.cursor = '';
  }
});


async function postDataToServer(eventData) {//イベント登録
  console.log("通信sitemasu");
  
  const json = await fetch(`/calendar_register`, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': csrfToken // CSRFトークンをヘッダーに追加
    },
    body: JSON.stringify(eventData),
  })

  .then(response => response.json()) // 返ってきたレスポンスをjsonで受け取って次のthenへ渡す
  .then(data => {
    console.log("koko");
    console.log(data); // 返ってきたデータ
    

    const returndata = {
      schedule_id: data.schedule_id,
      title: data.title,
      start: data.start,
      end: data.end,
      color: 'red'
    };
    console.log(returndata);
    calendar.addEvent(returndata);

    // return data;
  })

  .catch(error => {
      console.log(error); // エラー表示
  })

}

//JavaScript側はPHPから受け取る値をPHPタグ＆echoで出力する

// const schedule = JSON.parse('<?php echo $schedule_json; ?>');
// console.log({schedule});






calendar.render();
