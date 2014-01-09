<?php
$dominio = Router::url('/', true);
?>
<!DOCTYPE html>
<html lang="es" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8" />
    <title>Yo lo quiero para Navidad | Santander Universidades</title>

    <link rel="stylesheet" href="<?= $dominio?>frontend_css/continuar.css" />

    <!-- Add jQuery library -->
    <script type="text/javascript" src="<?= $dominio?>frontend_js/jquery-1.10.1.min.js"></script>

    <script type="text/javascript" src="<?= $dominio?>js/ranking/continuar.js"></script>

</head>
<body>
<div class="contenedor">
    <section class="titulo">
        <h2>¡TIEMPO FUERA!</h2>
    </section>
    <section>
        <form action="">
            <div class="texto">
                <span>hiciste <?=$tiempo ?> segundos</span> <br/>
                <span>y estás en el puesto <span class="puesto"><?=$puesto ?></span></span>
            </div>
            <div class="comentario">
                <span>¡Seguí jugando con Manu y mejorá</span> <br/>
                <span>tu tiempo!</span>
            </div>
            <div class="boton_registrarse">
                <input type="submit" class="boton" value="continuar"/>
            </div>
        </form>
    </section>
</div>
</body>
</html>