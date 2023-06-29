function genre_sort() {
  const kari = document.getElementById('genre').value;
  console.log("選択されました", kari);
  const link = document.getElementById("link");
  var baseURL = "http://localhost/genre_sort/";
  var url;
    url = baseURL + kari;
    window.location.href = url;

}