<x-app-layout>
  <main class="bg-yellow-200 m-7" >
    {{-- @include('schedule')一旦保留（開始日とか） --}}
    
    <div class="flex justify-between ">
      <p class="text-3xl w-7/12">{{ $title }}</p>
      <a class="mr-28" href="#chapter-form">ページ下部へ行く</a>
      @if($role ==1)
        <p>削除ボタン</p>
      @elseif($role ==0)
        <p></p>
      @endif
    </div>

    @foreach($all as $al)
      <form action="{{ route('sele_change',$id) }}" method="post">
      <div class="flex justify-between my-9 ml-9 mr-4">
        <div class="flex items-center w-full">
            @csrf
            @if($role ==1)
              <input type="radio" name="radio" value="{{ $al->id }}">
            @elseif($role ==0)
              <p>●</p>
            @endif
          <div class="flex-col ml-7 w-10/12">
            <a href="{{ route('Chapter_production',['id'=>$al->id]) }}">{{ $al->title }}</a>
            <p>{{ $al->body }}</p>
          </div>
        </div>
        @if($role ==1)
          <a class=text-6xl href="{{ route('sele_chap_delete', $al->id) }}" onclick="return confirm('本当に削除しますか?')">×</a>
        @elseif($role ==0)
          <p></p>
        @endif
      </div>
    @endforeach

    @if ($errors->has('change'))
      <li class='text-center'>{{$errors->first('change')}}</li>
      <script src="{{ asset('js/scroll.js') }}"></script>
    @endif
    @if ($errors->has('radio'))
      <li class='text-center'>{{$errors->first('radio')}}</li>
      <script src="{{ asset('js/scroll.js') }}"></script>
    @endif

    @if($role ==1)
      <div id="chapter-form" class="flex flex-col items-center">
        <div class="flex justify-between mt-2 w-96">
          <input type="text" id="" name="change" value="{{ old('change') }}">
          <button type="submit" id="change">登録チャプター名変更</button>
        </div>
        </form>
        <p>※変更するチャプター名にチェックを入れてください</p>

          @if ($errors->has('chapter_Name'))
            <li class='text-center'>{{$errors->first('chapter_Name')}}</li>
            <script src="{{ asset('js/scroll.js') }}"></script>
          @endif
      
        <form action="{{ route('chapter_Name',$id) }}" method="post">
          @csrf
          <div class="flex justify-between mt-2 w-96">
            <input type="text" id="" name="chapter_Name" value="{{ old('chapter_Name') }}">
            <button type="submit" id="chapter_Name">新規登録</button>
          </div> 
        </form> 
      </div>
    @endif

    <div class="flex justify-between ">
      <div class="text-left">
        <a href="{{ route('top') }}" class="sele_back">戻る</a>
      </div>
      <div class="mx-auto">
        <a href="" class="mr-11">ページ上部へ行く</a>
      </div>
    </div>
  </main>
</x-app-layout>