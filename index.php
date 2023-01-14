<?php
// if ($auth){
//   
// }

include 'service.php';
  session_start();
  $auth = $_SESSION['auth'] ?? null;
if ($auth) {
  $userId = getUserId($_SESSION['login']);
  $cookieSessionText = 'session_start_ID'.$userId;
  if (!isset($_COOKIE[$cookieSessionText])){
    setcookie($cookieSessionText, intVal(microtime(true)*1000),time()+100000);
    }
  if(!isset($_COOKIE['currentID'])){
    setcookie('currentID', $userId, time() + 100000, "/");
  }

  $count = $_SESSION['entries'] ?? 0;
  $count++;
  $_SESSION['entries'] = $count;

}

if(isset($_POST['exit'])) {
  
  unset($_SESSION['auth']);
  setcookie("currentID", "", time() - 100000,"/");
  header('Location: ./index.php');
}

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
    <section class="bd">
      <div class="bd-text-wrapper">
        <h2>Поздравляем с Днём Рождения! И дарим скидку на все услуги 5%!</h2>
      </div>
    </section>  
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
      </div>
      <?php   
        }
      ?>
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
    <div class="modal-bd-wrapper">
      <div class="modal-bd">
        <h3>Для получения специальных скидок введите дату своего рождения:</h3>
        <input class="modal-input" type="date"></input>
        <button class="modal-close" type="submit">Отправить</button>
      </div>

    </div>
  <script src="./index.js"></script>
  </body>
</html>

<?php
