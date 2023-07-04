<x-app-layout>   
  <main class=" m-7">
    <div class="flex justify-between text-4xl font-black mr-10">
      <p class="w-9/12">{{ $title }}→{{ $record['title'] }}</p>
      <div class="flex justify-between items-start">
        <button id="myButton" type="button" class="items-start inline-block align-top">

          @if(is_null($favorite))
            <i id="heart" class="fa-solid fa-heart "></i>
          @else
            <i id="heart" class="fa-solid fa-heart text-fuchsia-400"></i>
          @endif

        </button>
        <p id={{ $record['id'] }} class="ml-7 like hidden"></p>
      </div>
    </div>
    <p class="mb-5 mr-10 whitespace-pre-wrap">{{ $record['body'] }}</p>
    <div class="flex justify-between font-black">
      <a class="bg-transparent hover:bg-green-500 text-green-700 font-semibold hover:text-white py-1 px-2 border border-green-500 hover:border-transparent rounded" href="{{ route('select_chapter', $record['articles_id']) }}">戻る</a>
      <a class="bg-transparent hover:bg-green-500 text-green-700 font-semibold hover:text-white py-1 px-2 border border-green-500 hover:border-transparent rounded" href="{{ route('select_chapter', $record['articles_id']) }}">完了</a>
    </div>
  </main>
</x-app-layout>