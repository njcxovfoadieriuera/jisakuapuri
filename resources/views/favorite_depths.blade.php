<x-app-layout>
  <main class="bg-gray-100 m-7" >
  <p class="text-2xl">お気に入り>{{ $resultArray[0]['folder_title'] }}</p>
  
  <div class="m-7">
    <form action="" method="post">
      @csrf
      @foreach($resultArray as $result)
        <div class="flex justify-between ">
          <div class="flex">
            <!-- <button id="myButton" type="button" class=""> -->
              <input type="checkbox" id="chkbx" name="chkbx[]" value="{{ $result['favorite_id'] }}">
              <input type="hidden" name="folder_title" value={{ $result['folder_title'] }}>
            <!-- </button> -->

            <div class="mb-7">
              <h3 class="ml-6 font-black text-2xl font-mono">{{ $result['chapter_title'] }}</h3>
              <h4 class="ml-6 whitespace-pre-wrap">{{ $result['chapter_body'] }}</h4>
            </div>
          </div>
        </div>
      @endforeach
        <div class="flex justify-around">
          <input id="folder_dele" class="my-5 bg-transparent hover:bg-green-500 text-green-700 font-semibold hover:text-white h-8 py-1 px-2 border border-green-500 hover:border-transparent rounded" type="submit" value="グループ化の解除" formaction="{{ route('folder_lift_dep') }}">
          <p id="hidden2" class="hidden mt-20"></p>
          <input class="bg-transparent hover:bg-green-500 text-green-700 font-semibold hover:text-white h-8 py-1 px-2 border border-green-500 hover:border-transparent rounded" type="submit" value="お気に入りの削除" formaction="{{ route('folder_delete_dep') }}">
        </div>
    </form>
  </div>
    <a class="bg-transparent hover:bg-green-500 text-green-700 font-semibold hover:text-white h-8 py-1 px-2 border border-green-500 hover:border-transparent rounded" href="{{ route('favorite_like') }}">戻る</a> 
</x-app-layout>