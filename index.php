<?php
// if ($auth){
//   
// }

include 'service.php';
  session_start();
// echo "$username + $password";
  $auth = $_SESSION['auth'] ?? null;
if ($auth) {
  if (!isset($_COOKIE['session_start'])){
    setcookie('session_start', intVal(microtime(true)*1000),time()+100000);
    }
}

if(isset($_POST['exit'])) {
  
  unset($_SESSION['auth']);
  header('Location: ./index.php');
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <?php echo "<link rel='stylesheet' href='./index.css'>"; ?>
    <link rel="stylesheet" href="./index.css" />
    <link rel="icon" href="./images/icon.png" type="image/png">
    <title>Grand SPA Traditonal</title>
  </head>
  <body>
    <main>
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
        if($auth && $_COOKIE['session_start'] < time()){
    ?>
    <div class="timer">
      <h3>Спасибо, что выбрали нас!</h3>
      <p>Успейте воспользоваться специальным предложением для новых пользователей:</p>
      <div class="timer_items">
        <div class="timer_item timer_hours">00</div>
        <div class="timer_item timer_minutes">00</div>
        <div class="timer_item timer_seconds">00</div>
      </div>
    </div>
    <?php   
        }
    ?>
      <div class="services">
        <div class="inrow">
          <div class="service service1">
            <h3>Классический массаж</h3>
            <img class="img sevice-img" src="./images/1.jpg">
            <p class="price">200$</p>
          </div>
          <div class="service service2">
            <h3>Улучшение кожи</h3>
            <img class="img sevice-img" src="./images/6.jpg">
            <p class="price">200$</p>
          </div>
          <div class="service service3">
            <h3>Традиционный массаж</h3>
            <img class="img sevice-img" src="./images/ckl.jpg">
            <p class="price">200$</p>
          </div>
        </div>
      </div>
      
    </section>
    <section class="services">
      
    </section>
    <section class="spa">
      <img src="./images/spa_pic.png">
    </section>
    </main>
  <script src="./index.js"></script>
  </body>
</html>

<?php
