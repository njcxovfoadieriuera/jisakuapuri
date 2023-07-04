<x-app-layout>
<main class=" m-7" >
    {{-- @include('schedule')一旦保留（開始日とか） --}}
  <p class='text-4xl font-black'>{{ $record['title'] }}</p>
  <p class='mb-5 whitespace-pre-wrap'>{{ $record['body'] }}</p>
  <div class="flex justify-between font-black">
    <a class="bg-transparent hover:bg-green-500 text-green-700 font-semibold hover:text-white py-1 px-2 border border-green-500 hover:border-transparent rounded" href="{{ route('top') }}">戻る</a>
    <a class="bg-transparent hover:bg-green-500 text-green-700 font-semibold hover:text-white py-1 px-2 border border-green-500 hover:border-transparent rounded" href="{{ route('select_chapter',[$record->id]) }}">開始</a>
  </div>
</main>
</x-app-layout>
{{-- 完成 --}}