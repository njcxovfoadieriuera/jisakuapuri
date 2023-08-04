<x-app-layout>
  <p id="countdown">テスト</p>
  <p id="default">1:00:00</p>
  <form id="fruitForm" action="{{ route('test_end') }}" method="post">
    @csrf
    <p>問１</p>
    <input type="radio" id="apple" name="toi1" value="answer1">
    <label for="apple">りんご</label><br>

    <input type="radio" id="orange" name="toi1" value="answer2">
    <label for="orange">オレンジ</label><br>

    <input type="radio" id="banana" name="toi1" value="answer3">
    <label for="banana">バナナ</label><br>

    <p>問２</p>
    <input type="radio" id="ka-" name="toi2" value="answer1">
    <label for="ca-">ka-</label><br>

    <input type="radio" id="hune" name="toi2" value="answer2">
    <label for="hune">hune</label><br>

    <input type="radio" id="baiku" name="toi2" value="answer3">
    <label for="baiku">baiku</label><br>

    <button id="end" type="submit">完了</button>
  </form>
</x-app-layout>