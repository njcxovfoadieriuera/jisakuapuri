const button = document.getElementById('myButton');
const heart = document.getElementById('heart');
const like = document.querySelector('.like');
const like2 = like.getAttribute("id");

button.addEventListener('click', event => {
  console.log("ボタンがクリックされました");
  console.log(like2);
  heart.classList.toggle('text-fuchsia-400');

  function like(){
    fetch(`/favorite/${like2}`,{
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
  like();
})