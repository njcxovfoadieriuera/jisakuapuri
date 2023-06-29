<x-app-layout>
  <main class="bg-yellow-200 m-7">
    <div class="flex justify-between text-3xl">
      <p class="w-9/12">{{ $title }}→{{ $record['title'] }}</p>
      <div class="flex justify-between items-start">
        <button id="myButton" type="button" class="items-start inline-block align-top">

          @if(is_null($favorite))
            <i id="heart" class="fa-solid fa-heart "></i>
          @else
            <i id="heart" class="fa-solid fa-heart text-fuchsia-400"></i>
          @endif

        </button>
        <p id={{ $record['id'] }} class="ml-7 like">お気に入りボタン</p>
      </div>
    </div>
    <p class="my-5 mx-10">{{ $record['body'] }}</p>
    <div class="flex justify-between">
      <a href="{{ route('select_chapter', $record['articles_id']) }}">戻る</a>
      <a href="{{ route('select_chapter', $record['articles_id']) }}">完了</a>
    </div>
  </main>
</x-app-layout>