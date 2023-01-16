const modalButton = document.querySelector('.modal-close');
const modalWindow = document.querySelector(".modal-bd-wrapper");
const hours = document.querySelector('.timer_hours');
const minuts = document.querySelector('.timer_minutes');
const seconds = document.querySelector('.timer_seconds');
const price = document.querySelectorAll('.price');
const style = document.head.appendChild(document.createElement("style"));

let cookiesObj = {};                                                      //создаем пустой объект для будущих данных куки
//разделяем строку с полученными из документа куки и добавляем в массив, удаляя пробелы
const cookies = Array.prototype.map.call(document.cookie.split(/;/),(e) => e.trim() ); 

for (let i = 0, lenght = cookies.length; i < lenght; i++){      
    let cookie = cookies[i].split(/=/);                                  //отделяем ключ от значения
    cookiesObj[cookie[0]] = cookie[1];                                   //добавляем ключ и значение в cookiesObj
    
}
let currentSession = 'session_start_ID'+cookiesObj.currentID;           //берем id текущего пользователя из куки

const discountTime  = parseInt(cookiesObj[currentSession]) + 86400000;  //получаем время из куки
//если таймер установлен, выполняем обработку
if (document.querySelector('.timer')){
    document.addEventListener('DOMContentLoaded', function() {
    function timer() {
        const deadline = discountTime - Date.now();                     //считаем сколько осталось до завершения акции
        let hour = Math.floor(deadline / 1000 / 60 / 60);               //получаем из метки времени часы
        let minute = Math.floor(deadline  / 1000 / 60) - (hour * 60);   //получаем из метки времени минуты
        let second = Math.floor(deadline / 1000 % 60);                  //получаем из метки времени секунды
        //подставлям в селекторы значения часа минуты и секунды
        hours.textContent = hour;                                       
        minuts.textContent = minute < 10 ? '0' + minute : minute;
        seconds.textContent = second < 10 ? '0' + second : second;
        
    }
    timer();
    timerId = setInterval(timer, 1000);                                  //вызываем функцию каждую секунду

})
}
//если установлен блок с поздравлением
if (document.querySelector('.bd')) {
    style.innerHTML = ".service h3::before {content: '-5% '; color: red}";              //добавляем "-5%" к названию услуги 
    //устанавливаем для каждой стоимости значение со скидкой
    price.forEach ((e) => {
        let elemPrice = parseInt(e.innerText.replace('$',""));                          //получаем значение стоимости услуги
        e.innerHTML = '<s>'+e.innerHTML+'</s>' +" "+ Math.floor(elemPrice *0.95)+"$";   //заменяем текст на значение со скидкой
    })
}