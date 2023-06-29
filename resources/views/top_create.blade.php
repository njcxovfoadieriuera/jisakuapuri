<x-app-layout>
  <main class="bg-yellow-200 m-7">
    <div class="">
      <form action="{{ route('top_cre') }}" method="post">
        @csrf
        <input type="hidden" name="record_id" value="{{ $record['id'] }}">
        {{-- <p class="top">{{ $record['id'] }}</p>idは持ってこれてる --}}
        <p class="text-3xl">{{ $record['title'] }}</p>

          @if ($errors->has('body'))
            <li>{{$errors->first('body')}}</li>
          @endif

        <div>
          <textarea class="m-7" name="body" id="syoki" cols="100" rows="10" placeholder="ここにコースの概要を入力してください">@isset($bari['body']){{ $bari['body']}}@elseif($record['body']){{($record['body']) }}@endisset</textarea>
        </div>
          @if ($errors->has('genre_id'))
            <li class='text-center'>{{$errors->first('genre_id')}}</li>
          @endif
        <div class="flex justify-between items-end">
          <a href="{{ route('top') }}">戻る</a>
          <select name="genre_id" class="w-1/4" id="">
            @foreach($genres as $genress)
                  <option value={{ $genress['id'] }}>{{ $genress['name'] }}</option>
            @endforeach
          </select>
          <button type="submit">登録</button>
        </div>
      </form>
    </div>
  </main>
</x-app-layout>
