const button = document.querySelector('button');
const form = document.querySelector('#blablabla');
const popup = document.querySelector('.popup');

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
console.log(cookiesObj.session_start)