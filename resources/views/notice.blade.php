<x-app-layout>
  <main class="bg-gray-100 m-7" >
    <div class="flex justify-between">
        <h1 class="text-3xl font-black">お知らせ</h1>
        <a class="mr-20" href="#notice-form">ページ下部に行く</a>
        @if($role ==1)
          <p>削除ボタン</p>
        @elseif($role ==0)
          <p></p>
        @endif
    </div>

    @foreach($all as $al)
      <form action="{{ route('not_change') }}" method="post">
      <div class="flex justify-between">  
        <div class="flex w-full items-center m-5">
            @csrf
            <input type="radio" name="radio" id="radio" value="{{ $al->id }}">
          <div class="ml-5 w-full">
            <a class="font-black underline font-mono" href="{{ route('not_create',['id'=>$al->id]) }}">{{ $al->title }}</a>
            <p class="ml-4">{{ $al->body }}</p>
          </div>
        </div>
            
        <div class="flex justify-end w-1/6 items-center">
          @if($role ==1)
            <a href="{{ route('not_delete',['id'=>$al->id]) }}" onclick="return confirm('本当に削除しますか?')" class="w-12 h-12 text-5xl">×</a>   
          @elseif($role ==0)
            <p></p>
          @endif
        </div>
      </div>
    @endforeach

    @if($role ==1)
      @if ($errors->has('change'))
        <li class='text-center'>{{$errors->first('change')}}</li>
        <script src="{{ asset('js/scroll.js') }}"></script>
      @endif
      @if ($errors->has('radio'))
        <li class='text-center'>{{$errors->first('radio')}}</li>
        <script src="{{ asset('js/scroll.js') }}"></script>
      @endif

      <div id="notice-form" class="flex flex-col items-center">
        <div class="mt-3 w-96 flex justify-between">
          <input type="text" id="" name="change" value="{{ old('change') }}">
          <button class="underline" type="submit" id="change">登録お知らせ名変更</button>
        </div>
        </form>
        <p>※変更するお知らせ名にチェックを入れてください</p>

            @if ($errors->has('news_Name'))
              <li class='text-center'>{{$errors->first('news_Name')}}</li>
              <script src="{{ asset('js/scroll.js') }}"></script>
            @endif
        
        <form action="{{ route('news_Name') }}" method="post">
          @csrf
          <div class="mt-3 w-96 flex justify-between mb-4">
            <input type="text" id="" name="news_Name" value="{{ old('news_Name') }}">
            <button class="underline" type="submit" id="news_Name">新規登録</button>
          </div>
        </form>
      </div>
    @endif
    <div class="flex justify-between ">
      <div class="text-left">
        <a class="font-black" href="{{ route('top') }}" >戻る</a>
      </div>
      <div class="mx-auto">
        <a href="">ページ上部に行く</a>
      </div>
    </div>
  </main>
</x-app-layout>
