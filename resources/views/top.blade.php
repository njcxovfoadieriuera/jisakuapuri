<x-app-layout>
  <main class="bg-gray-100 m-7" >
    <div class="flex justify-between ">
      <div class="text-left">
        <p class="text-2xl font-black">受講するコース選択</p>
      </div>
      <div class="mx-auto">
        <a class="mr-24" href="#top-form">ページ下部へ行く</a>
      </div>
    </div>

    <div class="mx-5">
      <div class="ml-12 flex justify-between">
        <form action="" class="" method="post">
          @csrf
          <select name="genre" id="genre" class="w-1/4" onchange="genre_sort()">
            @foreach($genres as $genre)
              <option value="{{ $genre->id }}">{{ $genre->name }}</option>
            @endforeach
          </select>
        </form>
        <div class="w-1/6 flex justify-end">
          @if($role ==1)
            <p>削除ボタン</p>
          @elseif($role ==0)
            <p class="hidden">完了</p>
          @endif
        </div>
      </div>

      @foreach($all as $al)
        <form action="{{ route('top_change') }}" method="post">
        <div class="flex justify-between">
          <div class="flex w-full items-center my-5">
              @csrf
              @if($role ==1)
                <input type="radio" name="radio" id="radio" value="{{ $al->id }}">
              @elseif($role ==0)
                <p>●</p>
              @endif
            <!-- </form> -->
            <div class="ml-5 w-full">
              <div class="flex">
                <a class="font-black underline font-mono" href="{{ route('top_create',$al->id) }}">{{ $al->title }}</a>
              </div>
              
              @if (isset($al->body))<p>{{ $al->body }}<p>@endif
              @if (!isset($al->body))<p>コースのタイトルをクリックしてコースの概要を記入してください<p>@endif

              
            </div>
          </div>
          
          <div class="flex justify-between w-1/4 ml-3/100 items-center">
            @if($role ==1)
              <a href="{{ route('select_chapter',$al->id) }}" class="flex items-center ml-8 underline">chapterに移動</a>
              <a href="{{ route('top_delete',$al->id) }}" onclick="return confirm('本当に削除しますか?')" class="w-12 h-12 text-5xl">×</a>
            @elseif($role ==0)
              <p></p>
            <p class="flex items-center text-3xl hidden">★</p>
            @endif
            
          </div>
        </div>
      @endforeach
    </div>

    @if ($errors->has('change'))
      <li class='text-center'>{{$errors->first('change')}}</li>
      <script src="{{ asset('js/scroll.js') }}"></script>
    @endif
    @if ($errors->has('radio'))
      <li class='text-center'>{{$errors->first('radio')}}</li>
      <script src="{{ asset('js/scroll.js') }}"></script>
    @endif

    {{-- @if ($errors->has('radio'))
      <li class='text-center'>{{$errors->first('radio')}}</li>
    @endifラジオボタンのバリデーションが出来てない --}}

    @if($role ==1)
      <div class="flex flex-col items-center">
        <!-- <form action="" method="post">
          @csrf -->
          <div class="mt-3 w-96 flex justify-between">
            <input type="text" id="" name="change" value="{{ old('change') }}">
            <button class="underline" type="submit" id="change">登録コース名変更</button>
          </div>
        </form>
        <p>※変更するコース名にチェックを入れてください</p>

          @if ($errors->has('Course_Name'))
            <li class='text-center'>{{$errors->first('Course_Name')}}</li>
            <script src="{{ asset('js/scroll.js') }}"></script>
          @endif

        <form action="{{ route('Course_Name') }}" method="post">
          @csrf
          <div class="mt-3 w-96 flex justify-between mb-4">
            <input type="text" id="" name="Course_Name" value="{{ old('Course_Name') }}">
            <button class="underline" type="submit" id="Course_Name">新規登録</button>
          </div>
        </form>

          @if ($errors->has('genre'))
            <li class='text-center'>{{$errors->first('genre')}}</li>
            <script src="{{ asset('js/scroll.js') }}"></script>
          @endif
         

        <form action="{{ route('genre') }}" method="post">
          @csrf
          <div class="mt-3 w-96 flex justify-between mb-4">
            <input type="text" id="" name="genre" value="{{ old('genre') }}">
            <button class="underline" type="submit" id="genre">ジャンル追加</button>
          </div>
        </form>
        
      </div>
    @endif
      <a  id="top-form" href="" class="flex justify-center">ページ上部へ行く</a>
  </main>
</x-app-layout>

             