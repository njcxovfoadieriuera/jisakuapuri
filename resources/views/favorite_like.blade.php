<x-app-layout>
  <main class=" m-7" >

  <div class="flex justify-between pr-20">
    <div class="text-left">
      <h1 class="text-2xl font-black">お気に入り</h1>
    </div>
    <div class="mx-auto">
      <a class=" hover:bg-black hover:text-white" href="#favorite-form">ページ下部へ行く</a>
    </div>
  </div>

  <form class="m-7" action="" method="post">
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
                <i class="fa-solid fa-folder fa-xl mt-3  text-yellow-400"></i>
                <i class="fa-regular fa-folder fa-xl mt-3 relative -left-6"></i>
                <input class="font-black font-mono text-2xl  hover:text-green-500 relative -left-6 cursor-pointer" type="submit" name="folder_title" value="{{ $folder_title }}" formaction="{{ route('favorite_depths') }}">
              </div>

              <h3 class="ml-10 ">@foreach($folder as $chap_title)・{{ $chap_title }}@endforeach</h3>  
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

          <div class="mb-7 w-full">
            <h2 class="ml-2 font-black text-2xl font-mono">{{ $favorite_record['article_title'] }}</h2>
            <details class="whitespace-pre-wrap ml-4 "><summary class="cursor-pointer ">{{ $favorite_record['chapter_title'] }}</summary>{{ $favorite_record['chapter_body'] }}</details>
          </div>



        </div>
        {{-- <a href="" class="w-12 h-12 text-5xl ">×</a> --}}
      </div>
    @endforeach

      @if ($errors->has('folder_name'))
        <li class='text-center'>{{$errors->first('folder_name')}}</li>
      @endif
    <div id="favorite-form" class="flex justify-between flex-wrap">
      <div class="flex justify-between items-center">
        <div class="flex items-center">
          <p>グループ名：</p>
          <input type="text" id="" class="rounded h-8" name="folder_name">
        </div>
        <input id="folder_button" class="ml-2 bg-transparent hover:bg-green-500 text-green-700 font-semibold hover:text-white h-8 py-1 px-2 border border-green-500 hover:border-transparent rounded" type="submit" value="グループ化" formaction="{{ route('folder_register') }}">
      </div>
      <input id="folder_dele" class="ml-2 bg-transparent hover:bg-green-500 text-green-700 font-semibold hover:text-white h-8 py-1 px-2 border border-green-500 hover:border-transparent rounded " type="submit" value="グループ化の解除" formaction="{{ route('folder_lift') }}">
      <input type="submit" class="ml-2 bg-transparent hover:bg-green-500 text-green-700 font-semibold hover:text-white h-8 py-1 px-2 border border-green-500 hover:border-transparent rounded" value="お気に入りの削除" formaction="{{ route('folder_delete') }}">
    </div>
  </form>


    <div class="flex justify-center">
      <a class=" hover:bg-black hover:text-white" href="">ページ上部に行く</a>
    </div>

</x-app-layout>