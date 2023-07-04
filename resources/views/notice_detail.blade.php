<x-app-layout>
  <main class="bg-gray-100 m-7">
    <div class="mr-7">
      <form action="{{ route('not_deep') }}" method="post">
        @csrf
        <input type="hidden" name="record_id" value="{{ $record['id'] }}">
        {{-- <p class="top">{{ $record['id'] }}</p>idは持ってこれてる --}}
        <p class="text-4xl ">{{ $record['title'] }}</p>

        <div class="">
        <p class="whitespace-pre-wrap">{{ $record['body'] }}</p>
        </div>
          @if ($errors->has('genre_id'))
            <li class='text-center'>{{$errors->first('genre_id')}}</li>
          @endif
        <div class="flex justify-between pt-10">
          <a class="bg-transparent hover:bg-green-500 text-green-700 font-semibold hover:text-white py-1 px-2 border border-green-500 hover:border-transparent rounded" href="{{ route('notice') }}">戻る</a>
        </div>
      </form>
    </div>
  </main>
</x-app-layout>
