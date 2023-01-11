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
if (isset($_POST['submit'])) {
  if ($_POST['login'] == "Test") {
    header("Location: ./index.php");
  }else{
    echo '<p>ОШибка</p>';
  }
}
?>