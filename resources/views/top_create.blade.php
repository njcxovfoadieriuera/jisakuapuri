<x-app-layout>
  <main class=" m-7">
    <div class="">
      <form action="{{ route('top_cre') }}" method="post">
        @csrf
        <input type="hidden" name="record_id" value="{{ $record['id'] }}">
        {{-- <p class="top">{{ $record['id'] }}</p>idは持ってこれてる --}}
        <p class="text-4xl">{{ $record['title'] }}</p>

          @if ($errors->has('body'))
            <li>{{$errors->first('body')}}</li>
          @endif

        <div>
          <textarea class="" name="body" id="syoki" cols="100" rows="10" placeholder="ここにコースの概要を入力してください">@isset($bari['body']){{ $bari['body']}}@elseif($record['body']){{($record['body']) }}@endisset</textarea>
        </div>
          @if ($errors->has('genre_id'))
            <li class='text-center'>{{$errors->first('genre_id')}}</li>
          @endif
        <div class="flex justify-between items-end">
          <a class="bg-transparent hover:bg-green-500 text-green-700 font-semibold hover:text-white py-1 px-2 border border-green-500 hover:border-transparent rounded" href="{{ route('top') }}">戻る</a>
          <select name="genre_id" class="w-1/4 py-1" id="">
            @foreach($genres as $genress)
                  <option value={{ $genress['id'] }}>{{ $genress['name'] }}</option>
            @endforeach
          </select>
          <button class="bg-transparent hover:bg-green-500 text-green-700 font-semibold hover:text-white py-1 px-2 border border-green-500 hover:border-transparent rounded" type="submit">登録</button>
        </div>
      </form>
    </div>
  </main>
</x-app-layout>
