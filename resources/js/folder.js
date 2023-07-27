const folder_button = document.getElementById('folder_button');
const chkbx_folder = document.querySelectorAll('.chkbx_folder');

chkbx_folder.forEach(function(checkbox) {
  checkbox.addEventListener('click', function() {
    const allUnchecked = Array.from(chkbx_folder).every(function(checkbox) {
      console.log("ボタンがクリックされました");
      folder_button.classList.add('hidden');
      return !checkbox.checked;
    });

    if (allUnchecked) {
      console.log("チェックが外れてます");
      folder_button.classList.remove('hidden');
      hidden1.classList.add('hidden');
    }
  });
});

//上がファイルのチェックを入れたときファイル化ボタンの非表示


// const chkbx = document.getElementById('chkbx');

// chkbx.addEventListener('click', event => {
//   console.log("ボタンがクリックされました");

//   function folder_del() {
//     if (document.getElementById('chkbx').checked) {
//       folder_dele.classList.add('hidden');
//       hidden2.classList.remove('hidden');
//     } else {
//       folder_dele.classList.remove('hidden');
//       hidden2.classList.add('hidden');
//     }
//   }
//   folder_del();

// })

const folder_dele = document.getElementById('folder_dele');
const chkbx = document.querySelectorAll('.chkbx');

chkbx.forEach(function(checkbox) {
  checkbox.addEventListener('click', function() {
    const allUnchecked = Array.from(chkbx).every(function(checkbox) {
      console.log("ボタンがクリックされました");
      folder_dele.classList.add('hidden');
      return !checkbox.checked;
    });

    if (allUnchecked) {
      console.log("チェックが外れてます");
      folder_dele.classList.remove('hidden');
      hidden2.classList.add('hidden');
    }
  });
});

