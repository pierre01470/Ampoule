  <?php
  define('LOGIN', 'admin');
  define('PASSWORD', 'admin');
  if (isset($_GET['logout'])){
    session_start();
    session_destroy();
    header("Location: index.php");
  }
  elseif (!empty($_POST['username']) && !empty($_POST['password'])) {
    // Sont-ils les mêmes que les constantes ?
    if ($_POST['username'] !== LOGIN) {
      $errorMessage = 'Mauvais login !';
      echo $errorMessage;
    } elseif ($_POST['password'] !== PASSWORD) {
      $errorMessage = 'Mauvais password !';
      echo $errorMessage;
    } else {
      // On ouvre la session
      session_start();
      // On enregistre le login en session
      $_SESSION['username'] = LOGIN;
      // On redirige vers le fichier admin.php
      header("Location: historic.php");
    }
  } else {
    $errorMessage = 'Veuillez inscrire vos identifiants svp !';
  }

  ?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <link rel="stylesheet" href="style_connect.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
  </head>

  <body>
    <div class="login">
      <h1>Login</h1>
      <form action="" method="post">
        <input type="text" name="username" placeholder="Username" required="required" />
        <input type="password" name="password" placeholder="Password" required="required" />
        <button type="submit" name="submit" class="btn btn-primary btn-block btn-large">S'identifier</button>
      </form>
    </div>
  </body>

  </html>