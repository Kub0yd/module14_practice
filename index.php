<?php
// if ($auth){
//   
// }

include 'service.php';
  session_start();
  $auth = $_SESSION['auth'] ?? null;                //переменная для отметки авторизованного пользователя
if ($auth) {
  $userId = getUserId($_SESSION['login']);          //переменная для хранения id пользователя (вызов из service.php)
  $cookieSessionText = 'session_start_ID'.$userId;  //название сессии конкретного пользователя
  if (!isset($_COOKIE[$cookieSessionText])){
    //устанавливаем куки с названием сессии конкретного пользователя
    setcookie($cookieSessionText, intVal(microtime(true)*1000),time()+100000);
    }
  if(!isset($_COOKIE['currentID'])){
    //храню куки с id пользователя для обработки js скриптом
    //это нужно для вывода разных таймеров для разных пользователей (не придумал как можно по-другому сделать)
    setcookie('currentID', $userId, time() + 100000, "/");
  }
  //подсчет кол-ва заходов в кабинет
  $countSession = 'entries_'.$_SESSION['login'];    //переменная для названия сессии, содержащая логин пользователя 
  $count = $_SESSION[$countSession] ?? 0;
  $count++;
  $_SESSION[$countSession] = $count;

}

if(isset($_POST['exit'])) {                           //если нажата кнопка Выход
  
  unset($_SESSION['auth']);                           //очищаем пометку логина
  setcookie("currentID", "", time() - 100000,"/");    //очищаем id
  header('Location: ./index.php');                    //возврат на страницу
}

if (isset($_POST["bd_submit"])) {
  $clientBd = $_SESSION['login'].'_bd';
  $_SESSION[$clientBd] = $_POST['bd_set'];
}
if (isset($_SESSION[$clientBd])) {
  $birthday = $_SESSION[$clientBd];

  $bd = explode('-', $birthday);
  $bd = mktime(0, 0, 0, $bd[1], $bd[2], date('Y') + ($bd[1].$bd[2] <= date('md')));
  $days_until = ceil(($bd - time()) / 86400);
}


//echo "Дней:  $days_until////";

// echo $_SESSION[$clientBd];
// echo '\n';
// echo $_SESSION[$countSession];
//echo var_dump($_POST['bd_submit']);

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- <?php echo "<link rel='stylesheet' href='./index.css'>"; ?> -->
    <link rel="stylesheet" href="./index.css" />
    <link rel="icon" href="./images/icon.png" type="image/png">
    <title>Grand SPA Traditonal</title>
  </head>
  <body>
    <main>
      <?php 
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
        if(!$auth){
      ?>
      <a href="./login.php" class="login-in">Log In</a>
      
      <?php   
        } else {
      ?>
      <div class="login-menu">
        <p class="login-name">Вы вошили как: <?php echo $_SESSION['login'];?></p>
        <form class="login-form" method="post">
          <input class="login-exit" type="submit" name="exit" value="Выйти"></input>
        </form>
      <?php
          if ($auth && $days_until < 365){
      ?>
      <p class="bd_until">Дней до дня рождения: <?php echo$days_until?></p>
      <?php 
       }  
      }
      ?>
      </div>
      <img src="./images/main.png">
    </section>
    <section class="discount">
      <?php
        if(!$auth){
      ?>
      <img class="discount-img" src="./images/discount_pic.png">
      <a href="./login.php" class="login-now">Войти сейчас</a>
      
      <?php   
        }
      ?>
      <?php

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
      if ($_SESSION[$countSession] == 11) {
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
 