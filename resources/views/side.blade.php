


<header class="flex justify-end items-center pr-10">
  <nav>
    <button id="button" type="button" class="fixed z-10 right-7 top-7">
      <i id="bars" class="fa-solid fa-bars fa-2x "></i>
      <i id="xmark" class="fa-solid fa-xmark fa-2x hidden text-white"></i>
    </button>
    <ul id="menu" class=" text-1xl fixed top-0 right-40 h-full w-full hidden text-white bg-green-500]">
      <li class="px-3 pt-8 pb-10 text-2xl font-bold">メニュー</li>
      <li class="p-3  hover:text-green-500 hover:bg-white font-bold"><a href="{{ route('top') }}">トップ</a></li>
      <li class="p-3 hover:text-green-500 hover:bg-white font-bold">
        <x-dropdown-link :href="route('profile.edit')">
          {{ __('Profile') }}
        </x-dropdown-link>
      </li>
        @if(Auth::user()->role === 0)
          <li class="p-3 hover:text-green-500 hover:bg-white font-bold"><a href="{{ route('favorite_like') }}">お気に入り</a></li>
        @endif
        @if(Auth::user()->role === 1)
          <li class="p-3 hover:text-green-500 hover:bg-white font-bold"><a href="{{ route('user_list') }}">ユーザー一覧</a></li>
        @endif
      
      <li class="p-3 hover:text-green-500 hover:bg-white font-bold"><a href="{{ route('notice') }}">お知らせ</a></li>
      <li class="p-3 hover:text-green-500 hover:bg-white font-bold"><a href="{{ route('calendar') }}">カレンダー</a></li>
      <li class="p-3 hover:text-green-500 hover:bg-white relative font-bold">
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <x-dropdown-link :href="route('logout')"
            onclick="event.preventDefault();
            this.closest('form').submit();">
            {{ __('Log Out') }}
          </x-dropdown-link>
        </form>
      </li>
      
    </ul>
  </nav>
</header>


