<x-app-layout>
  <main class=" m-7" >
    <div class="flex justify-between ">
      <div class="text-left">
        <h1 class="text-4xl font-black ml-14">お知らせ</h1>
      </div>
      <div class="mx-auto">
        <a class=" hover:bg-black hover:text-white mr-36" href="#notice-form">ページ下部に行く</a>
      </div>
    </div>

    @foreach($all as $al)
      <form action="{{ route('not_change') }}" method="post">
      <div class="flex justify-between">  
        <div class="flex w-3/4 items-center m-5">
            @csrf
            <input type="radio" name="radio" id="radio" value="{{ $al->id }}">
          <div class="ml-5 w-full">
            <a class="font-black font-mono text-2xl  hover:text-green-500" href="{{ route('not_create',['id'=>$al->id]) }}">{{ $al->title }}</a>
            <p class=" truncate">{{ $al->body }}</p>
          </div>
        </div>
            
        <div class="flex justify-end w-1/6 items-center">
          @if($role ==1)
            <a href="{{ route('not_delete',['id'=>$al->id]) }}" onclick="return confirm('本当に削除しますか?')" class="w-6 h-6 text-2xl mr-7"><i class="fa-solid fa-trash-can hover:text-red-500"></i></a>   
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
        <div class="mt-3 w-96 flex justify-between mb-10">
        <div>
          <input type="text" id="" class="rounded h-8" name="change" value="{{ old('change') }}">
          <p class="text-xs text-red-500">※変更するお知らせ名にチェックを入れてください</p>
        </div>
          <button class="bg-transparent hover:bg-green-500 text-green-700 font-semibold hover:text-white h-8 py-1 px-2 border border-green-500 hover:border-transparent rounded" type="submit" id="change">登録お知らせ名変更</button>
        </div>
        </form>

            @if ($errors->has('news_Name'))
              <li class='text-center'>{{$errors->first('news_Name')}}</li>
              <script src="{{ asset('js/scroll.js') }}"></script>
            @endif
        
        <form action="{{ route('news_Name') }}" method="post">
          @csrf
          <div class="mt-3 w-96 flex justify-between mb-4 h-8">
            <input type="text" id="" class="rounded" name="news_Name" value="{{ old('news_Name') }}">
            <button class="bg-transparent hover:bg-green-500 text-green-700 font-semibold hover:text-white h-8 py-1 px-2 border border-green-500 hover:border-transparent rounded" type="submit" id="news_Name">新規登録</button>
          </div>
        </form>
      </div>
    @endif
    <div class="flex justify-between ">
      <div class="mx-auto hover:bg-black hover:text-white">
        <a href="">ページ上部に行く</a>
      </div>
    </div>
  </main>
</x-app-layout>
