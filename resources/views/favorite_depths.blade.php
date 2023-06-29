<x-app-layout>
  <main class="bg-yellow-200 m-7" >
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

            <div class="mb-7 w-11/12">
              <h3 class="ml-6">{{ $result['chapter_title'] }}</h3>
              <h4 class="ml-10">{{ $result['chapter_body'] }}</h4>
            </div>
          </div>
        </div>
      @endforeach

      <div class="flex justify-between">
        <div></div>
        <div class="justify-center"> 
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
          <input id="folder_dele" class="my-8" type="submit" value="グループ化の解除" formaction="{{ route('folder_lift_dep') }}">
          <p id="hidden2" class="hidden mt-20"></p>
          <input type="submit" value="お気に入りの削除" formaction="{{ route('folder_delete_dep') }}">

        </div>
      </div>
    </form>
  </div>
    <a href="{{ route('favorite_like') }}">戻る</a> 
</x-app-layout>