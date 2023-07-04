<x-app-layout>
  <main class="m-7">
  <h1 class="text-4xl ml-7">ユーザー一覧</h1>
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
        <a class="w-5 text-right" href="{{ route('user_dele',$user['id']) }}"><i class=" fa-solid fa-trash-can hover:text-red-500"></i></a>
      </div>
    </form>
  @endforeach
</x-app-layout>
