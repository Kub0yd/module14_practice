<?php

include 'service.php';
  session_start();
  $auth = $_SESSION['auth'] ?? null;                 //переменная для отметки авторизованного пользователя
if ($auth) {
  $userId = getUserId($_SESSION['login']);           //переменная для хранения id пользователя (вызов из service.php)
  $cookieSessionText = 'session_start_ID'.$userId;   //название сессии конкретного пользователя
  if (!isset($_COOKIE[$cookieSessionText])){
    //устанавливаем куки с названием сессии конкретного пользователя
    setcookie($cookieSessionText, intVal(microtime(true)*1000),time()+100000);
    }
  if(!isset($_COOKIE['currentID'])){
    //храню куки с id пользователя для обработки js скриптом
    //это нужно для вывода разных таймеров для разных пользователей (не придумал как можно по-другому сделать)
    setcookie('currentID', $userId, time() + 100000, "/");
  }
  $countSession = 'entries_'.$_SESSION['login'];      //название для сессии учета входов
  $clientBd = $_SESSION['login'].'_bd';               //создаем название сессии конкретного пользователя для хранения даты рождения

}
//очистка сессий и куки
if(isset($_POST['exit'])) {                           //если нажата кнопка Выход
  unset($_SESSION['auth']);                           //очищаем пометку логина
  setcookie("currentID", "", time() - 100000,"/");    //очищаем id
  header('Location: ./index.php');                    //возврат на страницу
}
//создаем сессию со значением даты рождения
if (isset($_POST["bd_submit"])) {                     //получаем дату рождения из формы
  $_SESSION[$clientBd] = $_POST['bd_set'];            //присваем сессии дату рождения
}
//подсчет дней до дня рождения
if (isset($_SESSION[$clientBd])) {                    //проверяем, создана ли запись дня рождения
  $birthday = $_SESSION[$clientBd];                   //переменная для хранения значения даты рождения
  $bd = explode('-', $birthday);                      //разбиваем строку на элементы массива
  //получаем метку даты рождения
  $bd = mktime(0, 0, 0, $bd[1], $bd[2], date('Y') + ($bd[1].$bd[2] <= date('md')));
  $days_until = ceil(($bd - time()) / 86400);         //подсчет дней
} 

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./index.css" />
    <link rel="icon" href="./images/icon.png" type="image/png">
    <title>Grand SPA Traditonal</title>
  </head>
  <body>
    <main>

      <?php 
        // вывод сообщения с поздравлением, если день рождения совпадает с текущей датой
        if(isset($_SESSION[$clientBd]) && $days_until == 365) {
      ?>

    <section class="bd">
      <div class="bd-text-wrapper">
        <h2>Поздравляем с Днём Рождения! И дарим скидку на все услуги 5%!</h2>
      </div>
    </section>  

      <?php
        }
      ?>

    <section class="main">

       <?php
       //если пользователь не авторизирован выводим ссылку для входа
        if(!$auth){
      ?>

      <a href="./login.php" class="login-in">Log In</a>
      
      <?php 
      //если пользователь авторизирован выводим его имя и кнопку с возможностью выхода  
        } else {
      ?>

      <div class="login-menu">
        <p class="login-name">Вы вошили как: <?php echo $_SESSION['login'];?></p>
        <form class="login-form" method="post">
          <input class="login-exit" type="submit" name="exit" value="Выйти"></input>
        </form>

      <?php
        }
          //выводим сколько дней до дня рождения
          if ($auth && isset($_SESSION[$clientBd]) && $days_until < 365 && $_SESSION[$countSession] > 1){
      ?>

        <p class="bd_until">Дней до дня рождения: <?php echo$days_until?></p>

      <?php   
      }
      ?>

      </div>
      <img src="./images/main.png">
    </section>
    <section class="discount">
      <?php
        //если пользователь не авторизирован выводим плашку с объявленияем акций и дополнительную кнопку входа
        if(!$auth){
      ?>
      <img class="discount-img" src="./images/discount_pic.png">
      <a href="./login.php" class="login-now">Войти сейчас</a>
      
      <?php
        }
        //выводим таймер для новых пользователей
        if($auth && $_COOKIE['session_start'] < intVal(microtime(true)*1000)){
      ?>

    <div class="timer">
      <div class = "timer_items_wrapper">
        <h3>Спасибо, что выбрали нас!</h3>
        <p>Успейте воспользоваться специальным предложением для новых пользователей:</p>
        <div class="timer_items">
          <div class="timer_item timer_hours">00</div>
          <div class="timer_item timer_minutes">00</div>
          <div class="timer_item timer_seconds">00</div>
        </div>
      </div>
      <div class="special-anounce_wrapper">
          <div class="special-anounce">
            <p>Оздоровительные процедуры со скидкой 30%!</p>
            <img class="special-img" src="./images/v.jpg">
          </div>
      </div>
    </div>

    <?php   
        }
    ?>

    </section>
    <section class="services_wrapper">
      <div class="services">
        <div class="inrow">
          <div class="service service1">
            <h3>Классический массаж</h3>
            <img class="img sevice-img" src="./images/1.jpg">
            <p class="price">150$</p>
          </div>
          <div class="service service2">
            <h3>Улучшение кожи</h3>
            <img class="img sevice-img" src="./images/6.jpg">
            <p class="price">200$</p>
          </div>
          <div class="service service3">
            <h3>Традиционный массаж</h3>
            <img class="img service-img" src="./images/ckl.jpg">
            <p class="price">300$</p>
          </div>
        </div>
      </div>
    </section>
    <section class="spa">
      <img src="./images/spa_pic.png">
    </section>
    </main>

    <?php 
      //при повторном входе в ЛК выводим плашку с полем ввода даты рождения
      if (!isset($_POST["bd_submit"]) && $_SESSION[$countSession] == 2) {
    ?>

    <div class="modal-bd-wrapper">
      <div class="modal-bd">
        <form method="post" type="submit">
          <h3>Для получения специальных скидок введите дату своего рождения:</h3>
          <input class="modal-input" type="date" name="bd_set"></input>
         <button class="modal-close" type="submit" name="bd_submit">Отправить</button>
        </form>
      </div>
    </div>
    <?php 
      }
    ?>
  <script src="./index.js"></script>
  </body>
</html>

<?php
 