<?php
$dominio = Router::url('/', true);
?>
<!DOCTYPE html>
<html lang="es" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8" />
    <title>Yo lo quiero para Navidad | Santander Universidades</title>

    <link rel="stylesheet" href="<?= $dominio?>frontend_css/registro.css" />

    <!-- Add jQuery library -->
    <script type="text/javascript" src="<?= $dominio?>frontend_js/jquery-1.10.1.min.js"></script>

    <script type="text/javascript" src="<?= $dominio?>js/usuario/index.js"></script>

</head>
<body>
    <div class="contenedor">
        <section class="titulo">
            <h2>completá tus datos y jugá:</h2>
        </section>
        <section>
            <?php echo $this->Form->create('Usuario', array('id' => 'form_usuarios', 'class' => 'da-form', 'url' => array('controller' => 'usuarios', 'action' => 'index')));
            ?>
            <div class="frm_registro">
                <ul>
                    <li>
                        <label>•<span>nombre:</span></label>
                        <?php echo $this->Form->input('nombre', array('label' => false, 'div' => false)); ?>
                    </li>
                    <li>
                        <label>•<span>apellido:</span></label>
                        <?= $this->Form->input('apellido', array('label' => false, 'div' => false));?>
                    </li>
                    <li>
                        <label>•<span>dni:</span></label>
                        <?= $this->Form->input('dni', array('maxlength'=>'8','label' => false, 'div' => false));?>
                    </li>
                    <li>
                        <label>•<span>email:</span></label>
                        <?= $this->Form->input('email', array('label' => false, 'div' => false));?>
                    </li>
                    <li>
                        <span>Si sos el ganador, lo necesitaremos paracontactarte.</span>
                        <span>Asegurate de que sea una dirección válida.</span>
                    </li>
                    <li>
                        <label>•<span>fecha de nacimiento:</span></label>
                        <?= $this->Form->select('fecha_nacimiento.day', $dias, array('empty' => false)); ?>
                        <?= $this->Form->select('fecha_nacimiento.month', $meses, array('empty' => false)); ?>
                        <?= $this->Form->select('fecha_nacimiento.year', $años, array('empty' => false)); ?>
                    </li>
                    <li>
                        <label>•<span>Acepto bases y condiciones:</span></label>
                        <?= $this->Form->input('bases', array('type'=>'checkbox','label' => false, 'div' => false));?>
                        <div class="boton">
                            <input type="submit" value="enviar" id="enviar"/>
                        </div>
                    </li>
                </ul>
                <div style="clear: both;height: 28px;"></div>
            </div>
            </form>
        </section>
    </div>
</body>
</html>