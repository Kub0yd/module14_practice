const button = document.querySelector('button');
const form = document.querySelector('#blablabla');
const popup = document.querySelector('.popup');

const hours = document.querySelector('.timer_hours');
const minuts = document.querySelector('.timer_minutes');
const seconds = document.querySelector('.timer_seconds');

// button.addEventListener('click', () => {
//   form.classList.add('open');
//   popup.classList.add('popup_open');
// });
let cookiesObj = {};                                            //создаем пустой объект для будущих данных куки
let cookies = document.cookie.split(/;/);                       //разделяем строку с полученными из документа куки и добавляем в массив
for (let i = 0, lenght = cookies.length; i < lenght; i++){      
    let cookie = cookies[i].split(/=/);                         //отделяем ключ от значения
    cookiesObj[cookie[0]] = cookie[1];                          //добавляем ключ и значение в cookiesObj
}
const discountTime  = parseInt(cookiesObj.session_start) + 86400000;

document.addEventListener('DOMContentLoaded', function() {
    function timer() {
        const deadline = discountTime - Date.now();
        let hour = Math.floor(deadline / 1000 / 60 / 60);
        let minute = Math.floor(deadline  / 1000 / 60) - (hour * 60);
        let second = Math.floor(deadline / 1000 % 60);
        hours.textContent = hour;
        minuts.textContent = minute < 10 ? '0' + minute : minute;
        seconds.textContent = second < 10 ? '0' + second : second;
        
        console.log(second);
        
    }
    timer();
    
    timerId = setInterval(timer(), 1000);
})