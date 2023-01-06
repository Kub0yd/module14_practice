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
        <button>Показать форму</button>

        <div class="popup">
          <div class="popup__container">
            <div class="popup__wrapper">
              <div id="blablabla">
                <form role="form" action="./index.php" autocomplete="off" method="POST">
                  <label>Логин</label>
                  <input type="text" name="login">
                  <label>Пароль:</label>
                  <input type="text" name="password">
                  <!-- <a href="./index.php" > -->
                    <button type="submit" class="btn btn-success">Отправить</button>
                  <!-- </a> -->
                </form>
              </div>
            </div>
          </div>
        </div>
    </main>

    <script src="./index.js"></script>
  </body>
</html>