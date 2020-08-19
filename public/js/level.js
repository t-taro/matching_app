'use strict';

const levelOptions = document.querySelectorAll('#level>option');

levelOptions.forEach(option => {
  switch(option.textContent){
    case '1':
      option.textContent = '初心者歓迎！';
      break;
    case '2':
      option.textContent = 'バド歴1年';
      break;
    case '3':
      option.textContent = 'バド歴3年';
      break;
    case '4':
      option.textContent = 'バド歴5年以上';
      break;
  }
    
})