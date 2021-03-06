<body>
  <div class="Página">
  <style type="text/css">
    body {
     /* padding-top: 40px;
      padding-bottom: 40px;
      background-color: #eee;*/
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
    .estiloError 
    {
        color: red;
        animation: estiloError 4s linear forwards;
        -webkit-animation: estiloError 4s linear forwards;
        position: center;
        left: 200px;    
      }
      @keyframes estiloError 
      {
        0% { opacity: 0; }
        2% { opacity: 1; }
        98% { opacity: 1; }
        100% { opacity: 0; }
      }
      @-webkit-keyframes estiloError 
      {
        0% { opacity: 0; }
        2% { opacity: 1; }
        98% { opacity: 1; }
        100% { opacity: 0; }
      }
  </style>

<?php include RUTA_APP.'/views/inc/jumbotron.php'; ?>
  <div class="container">

    <form class="form-signin" method="POST" action="<?= RUTA_URL . '/Login/signin' ?>">
      <h2 class="form-signin-heading text-center">Inicio de Sesión</h2>
      <label for="inputEmail">Correo:</label>
      <input type="email" name="email" id="inputEmail" class="form-control" placeholder="nombre_usuario@dominio.com" required autofocus>
      <br>
      <label for="inputPassword" >Contraseña:</label>
      <input type="password" name="password" id="inputPassword" class="form-control" placeholder="**********" required minlength="4">
      <br>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button><br>
      <?php if(isset($datos['error_message'])) { echo "<span class=estiloError>".$datos['error_message']."</span>"; }?>
      <br>
      <br>
      <br>
      <a href="<?php echo RUTA_URL?>/Recuperacion/">Recuperar cuenta</a>
    </form>
  </div>
<?php include RUTA_APP.'/views/inc/footer.php'; ?>