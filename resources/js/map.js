var quill = new Quill('#editor-container', {
  modules: {
    toolbar: [
      [{ header: [1, 2, false] }],
      ['bold', 'italic', 'underline'],
      ['image'],
      [{'color': []},{'background': []}],
    ]
  },
  placeholder: 'ここに講義の内容を記述や画像の添付をしてください',
  theme: 'snow'  // or 'bubble'
});

// フォームが送信される際にQuillの内容をhiddenフィールドに設定
document.querySelector('form').addEventListener('submit', function() {
  var content = quill.root.innerHTML;
  document.querySelector('#editor-content').value = content;
});


// font-size
// const fontSizeArr = ['8px','9px','10px','12px','14px','16px','20px','24px','32px','42px','54px','68px','84px','98px'];
// var Size = Quill.import('attributors/style/size');
// Size.whitelist = fontSizeArr;
// Quill.register(Size, true);

