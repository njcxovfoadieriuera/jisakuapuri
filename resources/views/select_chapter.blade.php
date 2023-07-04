<x-app-layout>
  <main class=" m-7" >
    {{-- @include('schedule')一旦保留（開始日とか） --}}
    
    

    <div class="flex justify-between ">
      <div class="text-left">
        <p class="text-4xl font-black ml-10">{{ $title }}</p>
      </div>
      <div class="mx-auto ">
        <a class="hover:bg-black hover:text-white h-6 mr-32" href="#chapter-form">ページ下部へ行く</a>
      </div>
    </div>

    @foreach($all as $al)
      <form action="{{ route('sele_change',$id) }}" method="post">
      <div class=" flex justify-between mb-10 mr-7">
        <div class="flex items-center w-11/12">
            @csrf
            @if($role ==1)
              <input type="radio" name="radio" value="{{ $al->id }}">
            @elseif($role ==0)
              <p>●</p>
            @endif
          <div class="flex-col ml-7 w-11/12">
            <a class="text-2xl font-black font-mono hover:text-green-500 " href="{{ route('Chapter_production',['id'=>$al->id]) }}">{{ $al->title }}</a>
            @if (isset($al->body))<p class="truncate">{{ $al->body }}<p>@endif
            @if (!isset($al->body))<p>チャプターのタイトルをクリックしてコースの概要を記入してください<p>@endif
          </div>
        </div>
        @if($role ==1)
          <a class="text-2xl w-6 h-6 mt-4" href="{{ route('sele_chap_delete', $al->id) }}" onclick="return confirm('本当に削除しますか?')"><i class="fa-solid fa-trash-can hover:text-red-500"></i></a>
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
      <div class="flex flex-col items-center">
        <div class="flex justify-between mt-2 w-96 h-8 mb-10">
          <div>
            <input type="text" id="" class="rounded h-8" name="change" value="{{ old('change') }}">
            <p class="text-xs text-red-500">※変更するコース名にチェックを入れてください</p>
          </div>

          <button class="bg-transparent hover:bg-green-500 text-green-700 font-semibold hover:text-white h-8 py-1 px-2 border border-green-500 hover:border-transparent rounded" type="submit" id="change">登録チャプター名変更</button>
        </div>
        </form>

          @if ($errors->has('chapter_Name'))
            <li class='text-center'>{{$errors->first('chapter_Name')}}</li>
            <script src="{{ asset('js/scroll.js') }}"></script>
          @endif
      
        <form action="{{ route('chapter_Name',$id) }}" method="post">
          @csrf
          <div class="flex justify-between mt-2 w-96 h-8">
            <input type="text" id="" class="rounded" name="chapter_Name" value="{{ old('chapter_Name') }}">
            <button class="bg-transparent hover:bg-green-500 text-green-700 font-semibold hover:text-white h-8 py-1 px-2 border border-green-500 hover:border-transparent rounded" type="submit" id="chapter_Name">新規登録</button>
          </div> 
        </form> 
      </div>
    @endif

    <div class="flex justify-center">      
        <a id="chapter-form" href="" class="mr-11 hover:bg-black hover:text-white">ページ上部へ行く</a>
    </div>
  </main>
</x-app-layout>