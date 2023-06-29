<x-app-layout>
<main class="bg-yellow-200 m-7" >
    {{-- @include('schedule')一旦保留（開始日とか） --}}
  <p class='text-3xl'>{{ $record['title'] }}</p>
  <p class='m-7'>{{ $record['body'] }}</p>
  <div class="flex justify-between">
    <a href="{{ route('top') }}">戻る</a>
    <a href="{{ route('select_chapter',[$record->id]) }}">開始</a>
  </div>
</main>
</x-app-layout>
{{-- 完成 --}}