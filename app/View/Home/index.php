<?php
$dominio = Router::url('/', true);
?>

<!DOCTYPE html>
<html lang="es" xmlns="http://www.w3.org/1999/html">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>adcentral</title>
    <meta name="description" content="">

    <!-- The CSS -->
    <link rel="stylesheet" href="<?= $dominio?>frontend_css/style.css">
    <link rel="stylesheet" href="<?= $dominio?>frontend_css/responsive.css">

    <!-- Add jQuery library-->
    <script type="text/javascript" src="<?= $dominio?>frontend_js/jquery-1.10.1.min.js"></script>

    <script type="text/javascript" src="<?= $dominio?>js/home/facebook.js"></script>
    <script type="text/javascript" src="<?= $dominio?>js/home/main.js"></script>
    <script type="text/javascript" src="<?= $dominio?>js/juego/juego.js"></script>

    <!-- Add Twitter library -->
    <script src="http://platform.twitter.com/widgets.js" type="text/javascript"> </script>

    <!-- Add fancyBox-->
    <link rel="stylesheet" href="<?= $dominio?>frontend_js/fancybox/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
    <script type="text/javascript" src="<?= $dominio?>frontend_js/fancybox/jquery.fancybox.js?v=2.1.5"></script>
    <script type="text/javascript" src="<?= $dominio?>frontend_js/fancybox/modernizr.js"></script>

    <!-- Add Facebook library -->
    <script src="https://connect.facebook.net/en_US/all.js"></script>

    <script>

        $(document).ready(function(){

            var  facebook=new FacebookApi();
            ///var dni='12345670';

            $('.btnFacebook').click(function(){
                if(ajax_puede_compartir()){
                    facebook.postearMuro(callbackFacebook);
                }
                return false;
            });

            /*Callback Compartir Facebook*/
            function callbackFacebook(response){
                /* Registrar BD base de datos*/
               console.log(response);
               if (response != undefined) {
                   ajax_compartir('FACEBOOK');
               }
            }

            $('.btnTwitter').click(function(){
                if(ajax_puede_compartir()){
                    return true;
                }else{
                    /*Mostrar mensaje de ya compartio*/
                }
                return false;

            });

            /*Callback Compartir Twitter*/
            twttr.events.bind('tweet', function(event) {
                /* Registrar BD base de datos*/
                ajax_compartir('TWITTER');
            });

            $('.btnEmail').click(function(){
                /* Registrar BD base de datos*/
                if(ajax_puede_compartir()){
                    /*Mostrar Form para compartir por email*/
                    return true;
                }else{
                    /*Mostrar mensaje de ya compartio*/
                }
                return false;
                //ajax_compartirEmail();
                //ajax_compartir('EMAIL');
            }) ;

            function ajax_puede_compartir(){
                var res=false;
                $.ajax({
                    data: '',
                    url:   "/compartirs/ajax_compartio/",
                    async:false,
                    beforeSend: function(){
                        $("body").append('<div id="fancybox-loading"><div></div></div>');
                    },
                    success:  function (response) {
                        $("#fancybox-loading").remove();
                        if(response=="noOk"){
                            res = true;
                        }
                        console.log(response);
                    }
                });

                return res;
            }

            function ajax_compartirEmail(){
                $.ajax({
                    data:'',
                    url:   "/compartirs/ajax_compartir_email/",
                    async:true,
                    dataType: "json",
                    beforeSend: function(){
                        $("body").append('<div id="fancybox-loading"><div></div></div>');
                    },
                    success:  function (response) {
                        $("#fancybox-loading").remove();

                        var datos=eval(response);
                        console.log(response);

                        if(datos.msg=='Ok'){
                            console.log('se envio correctamente');
                        }else{
                            console.log('error al enviar');
                        }
                    }
                });
            }

            function ajax_compartir(medio){
                $.ajax({
                    data: '',
                    url:   "/compartirs/ajax_compartir/"+medio,
                    async:true,
                    dataType: "json",
                    beforeSend: function(){
                        $("body").append('<div id="fancybox-loading"><div></div></div>');
                    },
                    success:  function (response) {
                        $("#fancybox-loading").remove();

                        var datos=eval(response);
                        console.log(response);

                        if(datos.msg=='compartio'){
                            alert('Ud ya compartio el dia de hoy');
                        }else{
                            if(datos.msg=='Ok' && datos.ganador=='Ok'){
                                alert('Felicitacion ganaste un/a '+datos.premio+' con has:'+ datos.hash);
                            }
                        }
                    }
                });
            }
            callbackStop=btnContinuar;
            /* Boton continuar*/
            function btnContinuar(time){
                openFancy('/rankings/continuar/'+time);
            }
            /* abrir Fancy*/
            function openFancy(url){
                $(".fancy").attr('href',url);
                $(".fancy").click();
            }

            $(".fancy").fancybox({
                fitToView	: false,
                maxWidth	:  607,
                width	: '100%',
                scrolling   : 'no',
                autoSize : true,
                openEffect 	: 'elastic',
                closeEffect 	: 'elastic',
                openSpeed : 600,
                closeSpeed: 600,
                padding: 0,
                margin: 0,
                opacity:1,
                type:'iframe',
                afterClose : function() {
                    if(!isLogeado()){
                        if($('.fancy').attr('href')=='/usuarios/login'){
                            openFancy('/usuarios/index');
                        }else{
                            openFancy('/usuarios/login');
                        }
                    }else{
                        btn_comenzar();
                    }
                    return;
                }
            });


            /*ver si esta logeado*/
            function isLogeado(){
                var res=false;
                $.ajax({
                    data: '',
                    url:   "/usuarios/ajax_islogin/",
                    async:false,
                    dataType: "json",
                    beforeSend: function(){
                        //$("body").append('<div id="fancybox-loading"><div></div></div>');
                    },
                    success:  function (response) {
                        //$("#fancybox-loading").remove();

                        var datos=eval(response);
                        console.log(response);

                        if(datos.msg=='Ok'){
                            res=true;
                            console.log('se envio correctamente');
                        }
                    }
                });
                return res;
            }

            $('.link-2').click(function(){
                openFancy('/home/conoce');
                return false;
            }) ;

            /* Init de todo*/
            openFancy('/usuarios/login');

            /* animacion mensaje footer*/
            var mensaje=0;
            setInterval( function(){
                var tag1=$(".contend_txt1 div:eq("+mensaje+")");
                var tag2=$(".contend_txt1 div:eq("+((mensaje+1) % 2)+")");
                $(tag1).animate({
                    left: "+=-300"
                }, 300, function() {
                    $(tag2).css('left','-300px');
                    $(tag1).css('display','none');
                    $(tag2).css('display','block');

                    $(tag2).animate({
                        left: "+=300"
                    }, 300, function() {
                        mensaje= (mensaje+1) % 2 ;
                    });
                });
            }, 4000);
        });

    </script>

</head>
<body>
<div id="wrapper">
    <div class="header">
        <a href="#"  class="fancy"><img src="" alt="" /></a>
        <ul class="menu">
            <li><a class="link-1" href="#" >¿COMO JUEGO?</a></li>
            <li><a class="link-2" href="#" >CONOCE AL EQUIPO QUE TE ACOMPAÑA</a></li>
            <li><a class="link-3" href="#" >GANADORES</a></li>
        </ul>

        <div class="avatar">
            <img src="" width="40" height="40" />
            <div class="texto-1">PUESTO</div>
            <div class="texto-2">00000</div>
        </div>
    </div>
    <div class="contenedor">
        <canvas id="gameCanvas" class="panel"  width="650px" height="400px">

        </canvas>
    </div>

    <div class="tiempo"><span>00</span>-<span>00</span>-<span>00</span></div>
    <div class="sebas"></div>

    <div class="premios">
        <div class="premios-fondo">
            <a href="#" class="solapa"></a>
            <div class="circulo nivel-1"></div>
            <a href="#" class="icono-1"></a><div class="tooltip-1"></div>
            <a href="#" class="icono-2"></a><div class="tooltip-2"></div>
            <a href="#" class="icono-3"></a><div class="tooltip-3"></div>
            <a href="#" class="icono-4"></a><div class="tooltip-4"></div>
        </div>
    </div>
    <div class="footer">
        <div class="numero-1"><?=$compartidos; ?></div>
        <div class="contend_txt1">
            <div class="texto-1">AYUDA  A LA FUNDACION MANU<br/> GOBILI CON UN CLICK Y<br/> GANA PREMIOS INSTANTANEOS</div>
            <div class="texto-1" style="display: none">COMPARTÍ EL JUEGO CON TUS<br/> AMIGOS. CADA NUEVO<br/> COLABORADOR SUMA 1 PESO</div>
        </div>
        <a class="link-1 btnFacebook" href=""></a>
        <a class="link-2 btnTwitter" href="https://twitter.com/intent/tweet?url=https://equipolasegunda.com.ar/&text=Hac%C3%A9%20Equipo%20con%20La%20segunda"></a>
        <a class="link-3 btnEmail" href=""></a>
    </div>

    <!--<div class="mi-fancy"></div>-->
    <a href="#" class="btn-comenzar"></a>

</div>
</body>
</html>