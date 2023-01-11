<?php
// if ($auth){
//   
// }

include 'service.php';
$username = $_POST['login'] ?? null;
$password = $_POST['password'] ?? null;


if (null !== $username || null !== $password) {

    // Если пароль из базы совпадает с паролем из формы
    if (checkPassword($username, $password)) {
    
         // Стартуем сессию:
         session_start(); 
        
   	 // Пишем в сессию информацию о том, что мы авторизовались:
        $_SESSION['auth'] = true; 
        // Пишем в сессию логин и id пользователя
        $_SESSION['id'] = $users['admin']['id']; 
        $_SESSION['login'] = $username;
        //выставляем время первого входа на сайт
        if (!isset($_COOKIE['session_start'])){
          setcookie('session_start', intVal(microtime(true)*1000),time()+100000);
        }
        
    }
}
$auth = $_SESSION['auth'] ?? null;


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
    <?php
        if($auth){
      ?>

      <form method="post" action="./index.php">
        <input type="submit" name="exit" label="Выйти"></input>
      </form>
      
      <?php   
        }
      ?>
    <section class="main">
      <img src="./images/main.png">
    </section>
    <section class="discount">
      <img src="./images/discount_pic.png">
      <?php
        if(!$auth){
      ?>

      <a href="./login.php" class="login-now">Войти сейчас</a>
      
      <?php   
        }
      ?>
      <?php
        if($auth){
    ?>
    <div class="timer">
      <p>Специалльное предложение действует:</p>
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
if(isset($_POST['exit'])) {
  session_unset();
}