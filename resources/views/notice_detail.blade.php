<x-app-layout>
  <main class="bg-gray-100 m-7">
    <div class="mr-7">
      <form action="{{ route('not_deep') }}" method="post">
        @csrf
        <input type="hidden" name="record_id" value="{{ $record['id'] }}">
        {{-- <p class="top">{{ $record['id'] }}</p>idは持ってこれてる --}}
        <p class="text-3xl py-5">{{ $record['title'] }}</p>

        <div class="ml-7">
        <p>{{ $record['body'] }}</p>
        </div>
          @if ($errors->has('genre_id'))
            <li class='text-center'>{{$errors->first('genre_id')}}</li>
          @endif
        <div class="flex justify-between pt-5">
          <a href="{{ route('notice') }}">戻る</a>
        </div>
      </form>
    </div>
  </main>
</x-app-layout>
