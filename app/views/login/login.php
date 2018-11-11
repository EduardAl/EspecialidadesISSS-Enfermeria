<?php require RUTA_APP.'\views\inc\header.php'; 
 ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>

    <style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #eee;
      }

      .form-signin {
        max-width: 330px;
        padding: 15px;
        margin: 0 auto;
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin .checkbox {
        font-weight: normal;
      }
      .form-signin .form-control {
        position: relative;
        height: auto;
        -webkit-box-sizing: border-box;
           -moz-box-sizing: border-box;
                box-sizing: border-box;
        padding: 10px;
        font-size: 16px;
      }
      .form-signin .form-control:focus {
        z-index: 2;
      }
      .form-signin input[type="email"] {
        margin-bottom: -1px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
      }
      .form-signin input[type="password"] {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
      }
    </style>

  </head>

  <body>

    <div class="container">

      <form class="form-signin" method="POST" action="<?= FOLDER_PATH . '/login/signin' ?>">
        <h2 class="form-signin-heading text-center">Inicio de Sesión</h2>
        <label for="inputEmail" class="sr-only">Correo:</label>
        <input type="email" name="email" id="inputEmail" class="form-control" placeholder="algo@dominio.com" required autofocus>
        <br>
        <label for="inputPassword" class="sr-only">Contraseña</label>
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="******" >
        <?php !empty($error_message) ? print($error_message) : '' ?>
        <br>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
      </form>

    </div> <!-- /container -->

  </body>
</html>

 <?php
 require RUTA_APP.'\views\inc\footer.php'; ?>