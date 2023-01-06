
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./index.css" />
    <title>&#x1F34C;Экзотические фрукты</title>
  </head>
  <body>
    <main>
    Test
    </main>
<?php

$username = $_POST['login'] ?? null;
$password = $_POST['password'] ?? null;
 
// зададим книгу паролей
$users = [
     'admin' => ['id' => '1', 'password' => '132432'],
];


if (null !== $username || null !== $password) {

    // Если пароль из базы совпадает с паролем из формы
    if ($password === $users['admin']['password']) {
    
         // Стартуем сессию:
        session_start(); 
        
   	 // Пишем в сессию информацию о том, что мы авторизовались:
        $_SESSION['auth'] = true; 
        
        // Пишем в сессию логин и id пользователя
        $_SESSION['id'] = $users['admin']['id']; 
        $_SESSION['login'] = $username; 

    }
}

    
$auth = $_SESSION['auth'] ?? null;

// если авторизованы
if ($auth) {
?>
<button>Показать форму</button>

<div class="popup">
  <div class="popup__container">
    <div class="popup__wrapper">
      <div id="blablabla">
        <form role="form" action="/requestFine" autocomplete="off" method="POST">
          <label>Ім'я:</label>
          <input type="text" name="nameReq">
          <label>Имя:</label>
          <input type="text" name="lastNameReq">
          <label>Телефон:</label>
          <input type="text" name="telReq">
          <label>Опис:</label>
          <input type="text" name="textReq">
          <button type="submit" class="btn btn-success">Отправить</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php }
?>

<script src="./index.js"></script>
</body>
</html>