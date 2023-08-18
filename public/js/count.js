if (typeof countdown != 'undefined') {

  const startTime = Date.now();

  //変数の定義---------------------------------------------------------------------
  var count   = 10;     //カウントダウンの数字を格納する変数  3分なので180
  var min     = 0;       //残り時間「分」を格納する変数
  var sec     = 0;       //残り時間「秒」を格納する変数
  var start_f = false; 
  var interval;
  //0042------------1秒毎にcont_down関数を呼び出す
        interval = setInterval(count_down,1000);
        start_f = true;
  //005------------カウントダウンの開始---------------------------------------------
  function count_down(){
  //006--------------------------------------------------------------------------
      if(count === 1){
          var display = document.getElementById("default");
          // display.style.color = 'red';
          // display.innerHTML = "TIME UP!";
          clearInterval(interval);

          // ここで目的のURLにリダイレクト
          // window.location.href = "/7-1/public/test_end"; // 遷移先のURLを指定してください
          // 経過時間をミリ秒で取得
          // const elapsedTime = Date.now() - startTime;
          // console.log(elapsedTime)//経過時間
          let endbutton =
          document.getElementById("end");
          endbutton.click();
  //007-------------------------------------------------------------------------
      } else {
  //008-------------------------------------------------------------------------
          count--;
  //009----------Math.floor関数を使って小数点になった分を整数に変換する。---------------
          min = Math.floor(count / 60);
  //010------------60秒で割ったあまりが秒となる-------------------------------------
          sec = count % 60;
          var count_down = document.getElementById("default");
          count_down.innerHTML = (min) +":" + ("0"+sec).slice(-2);
      }
  }
}


