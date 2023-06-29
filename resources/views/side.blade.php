


<header class="flex justify-end items-center pr-10">
  <nav>
    <button id="button" type="button" class="fixed z-10">
      <i id="bars" class="fa-solid fa-bars fa-2x "></i>
      <i id="xmark" class="fa-solid fa-xmark fa-2x hidden "></i>
    </button>
    <ul id="menu" class="fixed top-0 right-40 h-full w-full hidden ">
      <li class="p-3 pt-14"><a href="{{ route('top') }}">トップ</a></li>
      <li class="p-3 ">
        <x-dropdown-link :href="route('profile.edit')">
          {{ __('Profile') }}
        </x-dropdown-link>
      </li>
        @if(Auth::user()->role === 0)
          <li class="p-3"><a href="{{ route('favorite_like') }}">お気に入り</a></li>
        @endif
      <li class="p-3"><a href="{{ route('notice') }}">お知らせ</a></li>
      <li class="p-3 pt-60">
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

  {{-- 下がログアウト機能 --}}
  {{-- <form method="POST" action="{{ route('logout') }}">
    @csrf
    <x-dropdown-link :href="route('logout')"
      onclick="event.preventDefault();
      this.closest('form').submit();">
      {{ __('Log Out') }}
    </x-dropdown-link>
  </form> --}}
</header>


