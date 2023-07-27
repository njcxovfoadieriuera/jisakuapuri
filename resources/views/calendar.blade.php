<x-app-layout>
<?php $json_array = json_encode($formattedEvents); ?>{{-- phpの配列（連想配列）をjson化（json化しないとジャバスクリプトに渡せない） --}}
<script>
    var param = JSON.parse('<?php echo $json_array; ?>');
    var csrfToken = '<?php echo csrf_token(); ?>'; // CSRFトークンを取得
</script>{{-- ジャバスクリプトに変数paramを渡す --}}
  <main class="py-10 px-20 relative z-0">
    <div id='calendar'></div>
  </main>
</x-app-layout>