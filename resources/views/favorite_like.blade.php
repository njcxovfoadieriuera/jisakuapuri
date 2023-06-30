<x-app-layout>
  <main class="bg-gray-100 m-7" >

  <div class="flex justify-between pr-20">
    <div class="text-left">
      <h1 class="text-2xl">お気に入り</h1>
    </div>
    <div class="mx-auto">
      <a class="" href="#favorite-form">ページ下部へ行く</a>
    </div>
  </div>

  <form class="my-7 ml-7" action="" method="post">
    @csrf


    @if (isset($folder_array))
      @foreach($folder_array as $folder_title => $folder)
        <div class="flex justify-between">
          <div class="flex">
            <!-- <button id="myButton" type="button" class=""> -->
              <input type="checkbox" id="" class="chkbx_folder mt-1" name="chkbx_folder[]" value="{{ $folder_title }}">
            <!-- </button> -->
            <div class="ml-2 mb-7">
              <!-- <a href="" class="ml-2">{{ $folder_title }}</a> -->
              <div class="flex">
              <p>★</p>
                <input class="" type="submit" name="folder_title" value="{{ $folder_title }}" formaction="{{ route('favorite_depths') }}">
              </div>

              <h3 class="ml-6">@foreach($folder as $chap_title){{ $chap_title }}@endforeach</h3>  
            </div>
          </div>
          {{-- <a href="" class="w-12 h-12 text-5xl ">×</a> --}}
        </div>
      @endforeach
    @endif
    
      


    @foreach($favorite_records as $favorite_record)
      <div class="flex justify-between ">
        <div class="flex">
          <!-- <button id="myButton" type="button" class=""> -->
            <input type="checkbox" id="" class="chkbx mt-1" name="chkbx[]" value="{{ $favorite_record['favorite_id']}}">
          <!-- </button> -->

          <div class="mb-7 w-11/12">
            <h2 class="ml-2">{{ $favorite_record['article_title'] }}</h2>
            <h3 class="ml-6">{{ $favorite_record['chapter_title'] }}</h3>
            <h4 class="ml-10 w-full">{{ $favorite_record['chapter_body'] }}</h4>
          </div>
        </div>
        {{-- <a href="" class="w-12 h-12 text-5xl ">×</a> --}}
      </div>
    @endforeach

    <div id="favorite-form" class="flex justify-between">
      <div></div>
      <div class="justify-center">
        @if ($errors->has('folder_name'))
          <li class='text-center'>{{$errors->first('folder_name')}}</li>
        @endif
        <div class="flex justify-between items-center m-5">
          <p>チェックを入れた物をグループ化します。</p>
          <div class="flex items-center">
            <p>グループ名：</p>
            <input type="text" id="" name="folder_name">
          </div>
        </div>
        <div class="flex justify-between items-center m-5">
          <p>チェックをいれたグループ化されているお気に入りを取り出します。</p>
          <p>(お気に入りは解除されません)</p>
        </div>
        <div class="flex justify-between items-center m-5">
          <p>チェックを入れた物を削除します</p>
          <p>(お気に入りが削除されます)</p>
        </div>
      </div>
      <div class="flex flex-col">
        <input id="folder_button" class="mt-6" type="submit" value="グループ化ボタン" formaction="{{ route('folder_register') }}">
        <p id="hidden1" class="hidden mt-10"></p>
        <input id="folder_dele" class="my-8" type="submit" value="グループ化の解除" formaction="{{ route('folder_lift') }}">
        <p id="hidden2" class="hidden mt-20"></p>
        <input type="submit" value="お気に入りの削除" formaction="{{ route('folder_delete') }}">

      </div>
    </div>
  </form>


  <div class="flex justify-between ">
    <div class="text-left">
      <a href="{{ route('top') }}">戻る</a>
    </div>
    <div class="mx-auto">
      <a href="">ページ上部に行く</a>
    </div>
  </div>

</x-app-layout>