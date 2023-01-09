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
          setcookie('session_start', time(),time()+100000);
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