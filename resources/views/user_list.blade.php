<x-app-layout>
  <main class="m-7">

  <div class="flex ">
    <h1 class="text-4xl ml-7">ユーザー一覧</h1>
    <form method="post" action="{{ route('csv') }}">
    @csrf
      <textarea id="csv_name" name="csv_name" rows="1" cols="30" class="mr-2"></textarea>
      <button id="csv" type="submit" class="w-20 bg-red-500 rounded-lg">csv出力</button>
    </form>
  </div>

  @if ($errors->any())
    <div>
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <div class="flex justify-between mx-7 font-black">
    <p class="w-1/5 text-2xl">名前</p>
    <p class="w-1/5 text-2xl ">メールアドレス</p>
    <p class="w-1/5 text-2xl text-center">アカウント登録日</p>
    <p class="w-1/5 text-2xl text-right">権限</p>
    <p class="w-5 text-2xl "></p>
  </div>
  @foreach($users as $user)
    <form action="">
      <div class="flex justify-between m-7 font-bold hover:bg-green-500">
        <p class="w-1/5">{{ $user->name }}</p>
        <p class="w-1/5">{{ $user->email }}</p>
        <p class="w-1/5 text-center">{{ $user->created_at->format('Y/m/d') }}</p>
        @if($user['role'] ==1)
          <p class="w-1/5 text-right">管理者</p>
        @elseif($user['role'] ==0)
          <p class="w-1/5 text-right">ユーザー</p>
        @endif
        <a href="{{ route('chats_admin',$user['id']) }}">チャット</a>
        <a class="w-5 text-right" href="{{ route('user_dele',$user['id']) }}" onclick="return confirm('本当に削除しますか?')"><i class=" fa-solid fa-trash-can hover:text-red-500"></i></a>
      </div>
    </form>
  @endforeach
  
</x-app-layout>
