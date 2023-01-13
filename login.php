<?php
  session_start();
  $auth = $_SESSION['auth'] ?? null;
  if ($auth) {
    header("Location: ./index.php");
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php echo "<link rel='stylesheet' href='./style.css'>"; ?>
    <!-- <link rel="stylesheet" href="./index.css" /> -->
    <title>&#x1F34C;login</title>
  </head>

  <body>
    <div id="bg"></div>
    <form role="form"  autocomplete="off" method="POST">
      <div class="form-field">
        <input name="login" type="login" placeholder="Username" required/>
      </div>
      <div class="form-field">
        <input name="password" type="password" placeholder="Password" required/>                         
      </div>
      <div class="form-field">
        <button class="btn" type="submit" name="submit">Log in</button>
      </div>
    </form>


    <script src="./index.js"></script>
  </body>
</html>
<?php 
include 'service.php';

if (isset($_POST['submit'])) {
  // echo ($_POST['login']);
  $login = $_POST['login'];
  if (existsUser($_POST['login'])) {
    if (checkPassword($_POST['login'], md5($_POST['password']))) {
    //  file_get_contents($adress, false, stream_context_create($submitOpt));
    // Стартуем сессию:

        
    // Пишем в сессию информацию о том, что мы авторизовались:
      $_SESSION['auth'] = true; 
      // Пишем в сессию логин и id пользователя
      $_SESSION['login'] = $login;
      header("Location: ./index.php");
    }else {
      echo "<script>alert(\"Неккоректный пароль\");</script>";
    }
  }else{
    echo "<script>alert(\"Неверный логин!\");</script>";
  }
}

?>