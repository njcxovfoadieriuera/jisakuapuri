var stage = document.getElementById("stage");
if(stage){
//「月別データ」
var mydata = {
  labels: ["1回目", "2回目", "3回目"],
  datasets: [
    {
      label: '点数A',
      backgroundColor: "rgba(255,99,132,0.3)",
      data: [65, 59, 80],
      // fontSize:300,
    },{
      label: '点数B',
      backgroundColor: "rgba(111,200,12,0.9)",
      data: [20, 45, 70],  
    },{
      label: '点数C',
      backgroundColor: "rgba(1,90,172,0.5)",
      data: [48, 88, 96],
    }
  ]
};

//「オプション設定」
var options = {
  // plugins: {
  //   legend: {
  //     labels: {
  //       font: {
  //         size: 20 // データセットのラベルのフォントサイズを20に設定
  //       }
  //     }
  //   }
  // },
  
  title: {    
    display: true,
    text: 'コース1テスト',
    fontSize:40,
  },
  scales: {
    
    xAxes: [{
      scaleLabel: {                 // 軸ラベル
        display: true,                // 表示設定
        labelString: 'テスト回数',    // ラベル
        fontSize: 40                  // フォントサイズ
    },
      ticks: {
        fontSize:40,
        
      }
    }],
    yAxes: [{
      scaleLabel: {                 // 軸ラベル
        display: true,                // 表示設定
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


// Chart.defaults.font.size = 40;
var canvas = document.getElementById('stage');
var chart = new Chart(canvas, {
  
  type: 'bar',  //グラフの種類
  data: mydata,  //表示するデータ
  options: options  //オプション設定
  
});
}