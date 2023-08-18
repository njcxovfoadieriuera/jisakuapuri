<x-app-layout>
  <div class="mx-auto">
    <a class="mr-56  hover:bg-black hover:text-white" href="#top-form">ページ下部へ行く</a>
  </div>


  @if (isset($user->name))
    <p>{{ $user->name }}様とのトークルーム</p>
  @else
    <p>管理者様とのトークルーム</p>
  @endif
  

  <!-- 以下チャット機能ログ -->
  {{-- @if (isset($talks))
    @foreach($talks as $talk)
      <p id="fetchedData">{{ $talk['body'] }}</p>
    @endforeach
  @endif --}}

        <p id="fetchedData"></p>


  <form method="post" action="{{ route('chat', $user['id']) }}">
    @csrf
    <div class="flex">
      <textarea id="talk" name="talk" rows="1" cols="60" class="mr-2"></textarea>
      <button id="top-form" type="submit" class="w-12 bg-red-500 rounded-lg">送 信</button>
    </div>
  </form>
  
</x-app-layout>