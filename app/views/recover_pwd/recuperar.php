<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" 
    integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <title><?php echo NOMBRESITIO;?></title>
</head>
<body>
    <h1 class="display-1">Recuperar contraseña</h1>
    <p>Ingrese su correo para enviarle un correo para recuperar su contraseña:</p>
    <div class="container-fluid">
        <form action="<?php echo(RUTA_URL)?>/controlador_recuperarpwd/enviar_correo" method="post">
            <label for="email">Correo:</label>
            <input type="email" name="email" id="email" placeholder="correo@gmail.com" >
            <input type="submit" name="enviar" value="Enviar">
            <br>
        </form>
    </div>
 <?php require RUTA_APP.'\views\inc\footer.php'; ?>