<?php
$dominio = Router::url('/', true);
?>
<!DOCTYPE html>
<html lang="es" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8" />
    <title>Yo lo quiero para Navidad | Santander Universidades</title>

    <link rel="stylesheet" href="<?= $dominio?>frontend_css/login.css" />

    <!-- Add jQuery library -->
    <script type="text/javascript" src="<?= $dominio?>frontend_js/jquery-1.10.1.min.js"></script>

    <script type="text/javascript" src="<?= $dominio?>js/usuario/login.js"></script>

</head>
<body>
<div class="contenedor">
    <section class="titulo">
        <h2>Completá tus datos y jugá:</h2>
    </section>
    <section>
        <?php echo $this->Form->create('Usuario', array('id' => 'form_login', 'class' => 'da-form', 'url' => array('controller' => 'usuarios', 'action' => 'login')));
        ?>
        <div class="frm_login">
            <ul>
                <li>
                    <?= $this->Form->input('dni', array('placeholder'=>'INGRESAR DNI','label' => false, 'div' => false)); ?>
                    <div class="boton_enviar">
                        <input type="submit" class="boton" value="enviar" id="enviar"/>
                    </div>
                </li>
            </ul>
        </div></form>
        <div class="boton_registrarse">
            <input type="submit" class="boton" value="registrarse" id="registrarse"/>
        </div>

    </section>
</div>
</body>
</html>