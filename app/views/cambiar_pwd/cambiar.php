<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <input type="hidden" name="email" id="value" value="<?php echo($_GET['email']) ?>">
    <h1>Ingrese su nueva contraseña</h1>
    <form action="" method="post">
        <label for="pwd">contraseña</label>
        <input type="password" name="pwd" id="pwd">
        <input type="submit" value="Enviar">
    </form>
</body>
</html>