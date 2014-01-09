<?php
$dominio = Router::url('/', true);
?>
<!DOCTYPE html>
<html lang="es" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8" />
    <title>Yo lo quiero para Navidad | Santander Universidades</title>

    <link rel="stylesheet" href="<?= $dominio?>frontend_css/ganaste.css" />

    <!-- Add jQuery library -->
    <script type="text/javascript" src="<?= $dominio?>frontend_js/jquery-1.10.1.min.js"></script>

    <script type="text/javascript" src="<?= $dominio?>js/ranking/continuar.js"></script>

</head>
<body>
<div class="contenedor">
    <section class="titulo">
        <h2>¡FELICITACIONES!</h2>
    </section>
    <section>
            <div class="texto">
                <span>ganaste un/a <?= $premio?></span>
            </div>
            <div class="comentario">
                <span>Nos contactaremos con vos vía</span> <br/>
                <span> mail.</span>
            </div>
            <div class="boton_registrarse">
                <input type="submit" class="btn_txt" value="<?= $hash?>" onclick="return false;" />
            </div>
        </form>
    </section>
</div>
</body>
</html>