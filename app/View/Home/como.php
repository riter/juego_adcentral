<?php
$dominio = Router::url('/', true);
?>
<!DOCTYPE html>
<html lang="es" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8" />
    <title>Yo lo quiero para Navidad | Santander Universidades</title>

    <link rel="stylesheet" href="<?= $dominio?>frontend_css/como.css" />

    <!-- Add jQuery library -->
    <script type="text/javascript" src="<?= $dominio?>frontend_js/sbscroller/jquery-1.7.1.min.js"></script>

    <!--Add Plugin Sbscroller-->
    <script type="text/javascript" src="<?= $dominio?>frontend_js/sbscroller/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?= $dominio?>frontend_js/sbscroller/jquery.sbscroller.js"></script>
    <script type="text/javascript" src="<?= $dominio?>frontend_js/sbscroller/jquery.mousewheel.min.js"></script>
    <link rel="stylesheet" href="<?= $dominio?>frontend_js/sbscroller/jquery.sbscroller.css" />

    <script type="text/javascript" src="<?= $dominio?>js/home/como.js"></script>

</head>
<body>
<div class="contenedor">
    <section class="titulo">
        <h2>¿cómo juego?</h2>
    </section>
    <section class="contenido">
        <ul>
            <li>
                <span>¡JUGAR Y HACER EQUIPO CON LA SEGUNDA ES SÚPER FÁCIL!</span>
            </li>
            <li>
                <span class="pregunta">¿Qué tengo que hacer?</span>
                <span>Hacé click sobre el botón COMENZAR. <br/>
                      Mové el mouse para lograr el equilibrio de la pelota sobre el dedo de Manu. <br/>
                      Sumá la mayor cantidad de segundos y chequeá tu posición en el ranking.</span>
            </li>
            <li>
                <span class="pregunta">¿Cuántas oportunidades tengo?</span>
                <span>Si la pelota se cae, tenés más chances de jugar, sólo completa las dos consignas que se te indican y podrás JUGAR SIN LÍMITES.</span>
            </li>
            <li>
                <span class="pregunta">¿Quién gana?</span>
                <span>El jugador que esté primero al final de la semana, será el ganador del premio vigente.</span>
            </li>
            <li>
                <span class="pregunta">¿Hay un solo ganador?</span>
                <span>Cuantos más jugadores participen, mejores serán los premios. <br/>
                      Todas las semanas el ranking vuelve a cero para elegir a un nuevo ganador. </span>
            </li>
            <li>
                <span class="pregunta">¿Cómo me entero si gané?</span>
                <span>Nos contactaremos con el ganador vía mail. <br/>
                      El nombre del ganador de cada semana figurará en la sección “GANADORES”.</span>
            </li>
            <li>
                <span class="pregunta">¿Cómo colaboro con la Fundación Manu Ginóbili?</span>
                <span>Compartiendo el juego  en las redes sociales haciendo clic en la parte inferior de la pantalla. Cada nuevo colaborador suma 1 peso.  </span>
            </li>
            <li>
                <span>¡Además participas por premios instantáneos!</span>
            </li>
            <br/><br/><br/><br/><br/>
        </ul>
    </section>
</div>
</body>
</html>