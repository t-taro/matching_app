'use strict';

const token = document.getElementsByName('csrf-token').item(0).content;
const entryBtn = document.getElementById('entryBtn');

if(entryBtn){
  entryBtn.addEventListener('click', ()=>{
    let result = confirm('エントリーしますか？');
    
    if (result) {
      var formData = new FormData();
      var projectId = entryBtn.dataset.id;
      var url = "/project/entry";
      
      formData.append('id', projectId);
      
      fetch(url, {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': token
        },
        body: formData
      }).then(function (response) {
        return response.json();
      }).then(function (json) {
        if (json.entry === 'complete') {
          entryBtn.classList.remove('btn-outline-primary');
          entryBtn.classList.remove('btn-primary');
          entryBtn.textContent = 'エントリーしました';
          entryBtn.setAttribute("disabled", true);
          
          const entryCount = document.getElementById('entryCount');
          let countNum = parseInt(entryCount.textContent);
          countNum++;
          entryCount.textContent = countNum;
        }
      });
    };
  });
}