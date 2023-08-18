var stage = document.getElementById("stage");
if(stage){
  //「月別データ」
  var mydata = {
    labels: ["国語", "数学", "英語"],//テーブル：科目
    datasets: [
      {
        label: '1回目',
        backgroundColor: "rgba(255,99,132,0.3)",
        data: [65, 21, 58],//テーブル：点数
      },{
        label: '2回目',
        backgroundColor: "rgba(111,200,12,0.9)",
        data: [82, 57, 64],  
      },{
        label: '3回目',
        backgroundColor: "rgba(1,90,172,0.5)",
        data: [91, 70],
      },{
        label: '合格点',
        backgroundColor: "rgba(200,180,80,0.5)",
        data: [60,60,60],
      },{
        label: '平均点',
        backgroundColor: "rgba(0,0,0)",
        data: [79,49,61],
      }
    ]
  };

  //「オプション設定」
  var options = {
    
    title: {    
      display: true,
      text: '新宿太郎の小テスト結果',
      fontSize:40,
    },
    scales: {
      
      xAxes: [{
        scaleLabel: {                 // 軸ラベル
          display: true,                // 表示設定false
          labelString: 'テスト回数',    // ラベル
          fontSize: 40                  // フォントサイズ
      },
        ticks: {
          fontSize:40,
          
        }
      }],
      yAxes: [{
        scaleLabel: {                 // 軸ラベル
          display: true,                // 表示設定false
          labelString: '点数',    // ラベル
          fontSize: 40                  // フォントサイズ
      },
        ticks: {
          suggestedMax: 100,
          suggestedMin: 0,
          stepSize: 10,
          fontSize:40,
          
        }
      }]
    },
  };

  var chart = new Chart(stage, {
    
    type: 'bar',  //グラフの種類
    //line,bar,radar,pie,doughnut,polarArea,bubble,scatter

    data: mydata,  //表示するデータ
    options: options  //オプション設定
    
  });
}