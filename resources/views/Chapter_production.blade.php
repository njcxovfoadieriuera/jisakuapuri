<x-app-layout>
  <main class=" m-7">
    <div class="">
      <form action="{{ route('chap_pro') }}" method="post">
        @csrf
        <input type="hidden" name="chapter_id" value="{{ $id }}">
        <p class="text-3xl font-black">{{ $title }}</p>

          @if ($errors->has('body'))
            <li>{{$errors->first('body')}}</li>
          @endif

        <div>
          <textarea class="" name="body" id="syoki" cols="100" rows="10" placeholder="ここにチャプターの内容を書いてください">@isset($bari['body']){{ $bari['body']}}@elseif($body){{($body) }}@endisset</textarea>
        </div>
        <div class="flex justify-between font-black">
          <a class="bg-transparent hover:bg-green-500 text-green-700 font-semibold hover:text-white py-1 px-2 border border-green-500 hover:border-transparent rounded" href="{{ route('select_chapter',$articles_id) }}">戻る</a>
          <button class="bg-transparent hover:bg-green-500 text-green-700 font-semibold hover:text-white py-1 px-2 border border-green-500 hover:border-transparent rounded" type="submit">登録</button>
        </div>
      </form>
    </div>
  </main>
</x-app-layout>
