<x-app-layout>
  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3239.656784920611!2d139.80812547578913!3d35.710062672577926!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x60188ed0d12f9adf%3A0x7d1d4fb31f43f72a!2z5p2x5Lqs44K544Kr44Kk44OE44Oq44O8!5e0!3m2!1sja!2sjp!4v1692664875125!5m2!1sja!2sjp" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
  <p class="h-20 bg-red-600">action</p>

  <form action="{{ route('overview') }}" method="post">
    @csrf
    <input type="text" id="" class="rounded" name="title" value="{{ old('genre') }}">
    <div id="editor-container">{!! $modifiedContent !!}</div>
    <input type="hidden" id="editor-content" name="editor_content"> <!-- Quillの内容を保存するための隠しフィールド -->
    <button type="submit">新規登録</button>
  </form>
  {{-- <input type="hidden" id="modified-content" value="{!! $modifiedContent !!}" > --}}


  <div></div>
  
</x-app-layout>


