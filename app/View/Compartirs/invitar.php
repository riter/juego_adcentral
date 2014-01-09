<?php
$dominio = Router::url('/', true);
?>
<!DOCTYPE html>
<html lang="es" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8" />
    <title>Yo lo quiero para Navidad | Santander Universidades</title>

    <link rel="stylesheet" href="<?= $dominio?>frontend_css/invitar.css" />

    <!-- Add jQuery library -->
    <script type="text/javascript" src="<?= $dominio?>frontend_js/jquery-1.10.1.min.js"></script>

    <!--<script type="text/javascript" src="/js/home/home.js"></script>-->

</head>
<body>
<div class="contenedor">
    <section class="titulo">
        <h2>¡TIEMPO FUERA!</h2>
    </section>
    <section>
        <div class="texto">
            <span>hiciste xxx segundos</span> <br/>
            <span>y estás en el puesto xxx</span>
        </div>
        <div class="comentario">
            <span>Invitá a tres amigos y sumá tres chances</span> <br/>
            <span>de ganar.</span>
        </div>
        <div class="redes">
            <a href="#"></a>
            <a href="#"></a>
        </div>
        <form action="invitar_email" id="form_invitarEmail" method="post">
        <div class="form_invitar">
            <ul>
                <li>
                    <?= $this->Form->input('nombre1', array('placeholder'=>'nombre','label' => false, 'div' => false)); ?>
                    <?= $this->Form->input('email1', array('placeholder'=>'mail de tu amigo','label' => false, 'div' => false)); ?>
                </li>
                <li>
                    <?= $this->Form->input('nombre2', array('placeholder'=>'nombre','label' => false, 'div' => false)); ?>
                    <?= $this->Form->input('email2', array('placeholder'=>'mail de tu amigo','label' => false, 'div' => false)); ?>
                </li>
                <li>
                    <?= $this->Form->input('nombre3', array('placeholder'=>'nombre','label' => false, 'div' => false)); ?>
                    <?= $this->Form->input('email3', array('placeholder'=>'mail de tu amigo','label' => false, 'div' => false)); ?>
                </li>
            </ul>
        </div>
        <div class="boton_registrarse">
            <input type="submit" class="boton" value="enviar"/>
        </div>
        </form>
    </section>
</div>
</body>
</html>