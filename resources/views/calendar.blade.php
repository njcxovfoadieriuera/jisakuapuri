<x-app-layout>
<?php $json_array = json_encode($formattedEvents); ?>{{-- phpの配列（連想配列）をjson化（json化しないとジャバスクリプトに渡せない） --}}
<script>var param = JSON.parse('<?php echo $json_array; ?>');</script>{{-- ジャバスクリプトに変数paramを渡す --}}
  <main class="my-10 mx-20">
    <div id='calendar'></div>
  </main>
</x-app-layout>