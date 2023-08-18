var talk = document.getElementById('talk');
var kari =2//ここができてないuseridを入れないといけない
let isFirstExecution = true; // 初回実行フラグ

// console.log(kari);

// window.setTimeout(kari2, 1000);

function kari2(){
  // ページ読み込み時に実行したい処理
  let elm = document.documentElement;

  // scrollHeight ページの高さ clientHeight ブラウザの高さ
  let bottom = elm.scrollHeight - elm.clientHeight;

  // 垂直方向へ移動
  window.scroll(0, bottom);
  console.log('移動したい')
}

function kari3(){
  if (isFirstExecution) {
    kari2(); // 初回実行のみ kari2() 関数を呼び出す
    console.log('初回');
    isFirstExecution = false; // 初回実行済みフラグを更新
  }
}



function like(){
  fetch(`/chats_admin_fetch/${kari}`,{
  })
  .then(response => response.json()) // 返ってきたレスポンスをjsonで受け取って次のthenへ渡す
    .then(res => {
      // console.log(res);
      if (res.hasOwnProperty("talks") && Array.isArray(res["talks"])) {
        const innerTalks = res["talks"];
        console.log('紅葉や');

        const fetchedDataElement = document.getElementById('fetchedData');
        fetchedDataElement.textContent = ''; // 要素の中身をクリア

        innerTalks.forEach(talk => {
          if (talk.hasOwnProperty("body")) {
            const bodyValue = talk["body"];
            const user_idValue = talk["body"]+talk["user_id"];
            // console.log(user_idValue)

            //user_idValueをbladeにおくってクラスで左右に分けたい


            
            // bodyValue を文字列として表示
            const bodyParagraph = document.createElement("p");
            bodyParagraph.textContent = user_idValue;
            fetchedDataElement.appendChild(bodyParagraph);
          } else {
            console.log("No 'body' property in the talk.");
          }
        });
      } else {
        console.log("No 'talks' property in the response or talks is not an array.");
      }
      // console.log(res); // 返ってきたデータ
    })

    .catch(error => {
        console.log(error); // エラー表示
    })
}

// function likeAndExecuteKari2() {
//   like().then(() => {
//     if (isFirstExecution) {
//       kari2(); // 初回実行のみ kari2() 関数を呼び出す
//       console.log('初回');
//       isFirstExecution = false; // 初回実行済みフラグを更新
//     }
//   });
// }
// likeAndExecuteKari2();





if(talk){
// function start(id) {
//   // kari2();
// 	id = setInterval(function () {
// 		// 処理
//     console.log('つながっています')
    like();
//     // kari3();
    
// 	}, 500);
//   // kari2();
// }
// start('id');

}
// window.setTimeout(kari2, 1000);



// 管理者は多分完成
// 一般は未完成

// const func = async () => {
//   await like(); 
// };
// like = () => {
//   return new Promise(resolve => {
//     setTimeout(() => {
//       like();
//       resolve();
//     },500);
//   });
// }

// func();