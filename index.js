const modalButton = document.querySelector('.modal-close');
const modalWindow = document.querySelector(".modal-bd-wrapper");
const hours = document.querySelector('.timer_hours');
const minuts = document.querySelector('.timer_minutes');
const seconds = document.querySelector('.timer_seconds');
const price = document.querySelectorAll('.price');
const style = document.head.appendChild(document.createElement("style"));

let cookiesObj = {};                                            //создаем пустой объект для будущих данных куки
 //разделяем строку с полученными из документа куки и добавляем в массив, удаляя пробелы
const cookies = Array.prototype.map.call(document.cookie.split(/;/),(e) => e.trim() ); 

for (let i = 0, lenght = cookies.length; i < lenght; i++){      
    let cookie = cookies[i].split(/=/);                         //отделяем ключ от значения
    cookiesObj[cookie[0]] = cookie[1];                          //добавляем ключ и значение в cookiesObj
    
}
let currentSession = 'session_start_ID'+cookiesObj.currentID;

const discountTime  = parseInt(cookiesObj[currentSession]) + 86400000;

if (document.querySelector('.timer')){
    document.addEventListener('DOMContentLoaded', function() {
    function timer() {
        const deadline = discountTime - Date.now();
        let hour = Math.floor(deadline / 1000 / 60 / 60);
        let minute = Math.floor(deadline  / 1000 / 60) - (hour * 60);
        let second = Math.floor(deadline / 1000 % 60);
        hours.textContent = hour;
        minuts.textContent = minute < 10 ? '0' + minute : minute;
        seconds.textContent = second < 10 ? '0' + second : second;
        
    }
    timer();
    timerId = setInterval(timer, 1000);

})
}
if (document.querySelector('.bd')) {
    style.innerHTML = ".service h3::before {content: '-5% '; color: red}";
    price.forEach ((e) => {
        //console.log(e.innerText)
        let elemPrice = parseInt(e.innerText.replace('$',""));
        e.innerHTML = '<s>'+e.innerHTML+'</s>' +" "+ Math.floor(elemPrice *0.95)+"$";
    })
}