<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo NOMBRESITIO;?></title>
</head>
<body>
    <h1>Recuperar contraseña</h1>
    <p>Ingrese su correo para enviarle un correo para recuperar su contraseña:</p>
    <h1><?php echo(RUTA_URL)?></h1>
    <form action="<?php echo(RUTA_URL)?>/controlador_recuperarpwd/enviar_correo" method="post">
        <label for="email">Correo:</label>
        <input type="email" name="email" id="email" placeholder="correo@gmail.com" >
        <input type="submit" name="enviar" value="Enviar">
    </form>
 <?php require RUTA_APP.'\views\inc\footer.php'; ?>