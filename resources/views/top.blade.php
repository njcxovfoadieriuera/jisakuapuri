<x-app-layout>
  <main class=" m-7" >
    <div class="flex justify-between ">
      <div class="text-left">
        <p class="text-4xl font-black">受講するコース選択</p>
      </div>
      <div class="mx-auto">
        <a class="mr-56  hover:bg-black hover:text-white" href="#top-form">ページ下部へ行く</a>
      </div>
    </div>

    <div class="mx-5">
      <div class="ml-9 flex justify-between">
        <form action="" class="" method="post">
          @csrf
          <select name="genre" id="genre" class="py-1 rounded" onchange="genre_sort()">
            @foreach($genres as $genre)
              <option value="{{ $genre->id }}">{{ $genre->name }}</option>
            @endforeach
          </select>
        </form>
      </div>

      @foreach($all as $al)
        <form action="{{ route('top_change') }}" method="post">
        <div class="flex justify-between">
          <div class="flex w-2/3 items-center my-5">
              @csrf
              @if($role ==1)
                <input type="radio" name="radio" id="radio" value="{{ $al->id }}">
              @elseif($role ==0)
                <p>●</p>
              @endif
            <!-- </form> -->
            <div class="ml-5 w-full">
              <div class="flex">
                <a class="font-black font-mono text-2xl  hover:text-green-500" href="{{ route('top_create',$al->id) }}">{{ $al->title }}</a>
              </div>
              
              @if (isset($al->body))<p class="truncate">{{ $al->body }}<p>@endif
              @if (!isset($al->body))<p>コースのタイトルをクリックしてコースの概要を記入してください<p>@endif

              
            </div>
          </div>
          
          <div class="flex justify-between w-1/4 ml-3/100 items-center">
            @if($role ==1)
              <a href="{{ route('select_chapter',$al->id) }}" class="flex items-center bg-transparent hover:bg-green-500 text-green-700 font-semibold hover:text-white py-2 px-4 border border-green-500 hover:border-transparent rounded">chapterに移動</a>
              <a href="{{ route('top_delete',$al->id) }}" onclick="return confirm('本当に削除しますか?')" class=" w-6 h-6 text-2xl mr-5"><i class="ml-3 fa-solid fa-trash-can hover:text-red-500"></i></a>
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
          <div class="mt-3 w-96 flex justify-between mb-10">
          <div>
            <input type="text" id="" class="rounded h-8" name="change" value="{{ old('change') }}">
            <p class="text-xs text-red-500">※変更するコース名にチェックを入れてください</p>
          </div>  
            <button class="bg-transparent hover:bg-green-500 text-green-700 font-semibold hover:text-white h-8 py-1 px-2 border border-green-500 hover:border-transparent rounded" type="submit" id="change">登録コース名変更</button>
          </div>
        </form>
        

          @if ($errors->has('Course_Name'))
            <li class='text-center'>{{$errors->first('Course_Name')}}</li>
            <script src="{{ asset('js/scroll.js') }}"></script>
          @endif

        <form action="{{ route('Course_Name') }}" method="post">
          @csrf
          <div class="mt-3 w-96 flex justify-between mb-10 h-8 ">
            <input type="text" id="" class="rounded" name="Course_Name" value="{{ old('Course_Name') }}">
            <button class="bg-transparent hover:bg-green-500 text-green-700 font-semibold hover:text-white h-8 py-1 px-2 border border-green-500 hover:border-transparent rounded" type="submit" id="Course_Name">新規登録</button>
          </div>
        </form>

          @if ($errors->has('genre'))
            <li class='text-center'>{{$errors->first('genre')}}</li>
            <script src="{{ asset('js/scroll.js') }}"></script>
          @endif
         

        <form action="{{ route('genre') }}" method="post">
          @csrf
          <div class="mt-3 w-96 flex justify-between mb-4 h-8">
            <input type="text" id="" class="rounded" name="genre" value="{{ old('genre') }}">
            <button class="bg-transparent hover:bg-green-500 text-green-700 font-semibold hover:text-white h-8 py-1 px-2 border border-green-500 hover:border-transparent rounded" type="submit" id="genre">ジャンル追加</button>
          </div>
        </form>
        
      </div>
    @endif
     <div class="flex justify-center"> 
      <a  id="top-form" href="" class="ml-20 hover:bg-black hover:text-white">ページ上部へ行く</a>
    </div>
  </main>
</x-app-layout>

             