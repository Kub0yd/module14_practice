<?php
  session_start();
  $auth = $_SESSION['auth'] ?? null;
  //если пользователь авторизован его перкидывает на главную страницу
  if ($auth) {
    header("Location: ./index.php");
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php echo "<link rel='stylesheet' href='./login.css'>"; ?>
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
  </body>
</html>
<?php 
include 'service.php';

//обработка submit
if (isset($_POST['submit'])) {
  $login = $_POST['login'];                                             //записываем в переменную логи
  // проверям, существует ли пользователь с введенным логином (проверка из service.php)
  if (existsUser($login)) {
    //проверка пароля
    if (checkPassword($login, md5($_POST['password']))) {
      // Пишем в сессию информацию о том, что мы авторизовались:
      $_SESSION['auth'] = true; 
      // Пишем в сессию логин и id пользователя
      $_SESSION['login'] = $login;
      //подсчет кол-ва заходов в кабинет
      $countSession = 'entries_'.$login;    //переменная для названия сессии, содержащая логин пользователя 
      $count = $_SESSION[$countSession] ?? 0;
      $count++;
      $_SESSION[$countSession] = $count;
      header("Location: ./index.php");
    }else {
      echo "<script>alert(\"Неккоректный пароль\");</script>";
    }
  }else{
    echo "<script>alert(\"Неверный логин!\");</script>";
  }
}

?>