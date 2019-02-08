<body>
<?php require RUTA_APP.'/views/inc/jumbotron.php'; ?>

    <div class="container">
        <div class="col-xs-12" style="align-items: center;">
            <h1 >Recuperar contraseña</h1>
            <p>Ingrese su correo para enviarle una nueva contraseña:</p>
        </div>
        <form action="<?php echo(RUTA_URL)?>/recuperacion/enviar_correo" method="post">
            <div class="col-xs-12">
                <div class="col-xs-6">
                    <label class="navbar-right" for="email" >Correo:</label>
                </div>
                <div class="col-xs-6">
                <input type="email" name="email" id="email" placeholder="correo@gmail.com" class="form-control">
                <br>
                <input type="submit" name="enviar" value="Enviar" class="btn btn-lg btn-primary">
                </div>
            </div>
        </form>
    </div>
<?php require RUTA_APP.'/views/inc/footer.php'; ?>