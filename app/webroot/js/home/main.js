function mensajeComenzar(callBack){
    //$('.mi-fancy').show();
    $('.btn-comenzar').show();

    $('.btn-comenzar').unbind('click');
    $('.btn-comenzar').bind('click',function(){
        //$('.mi-fancy').hide();
        $('.btn-comenzar').hide();

        $(document).ready(function(){
            ocultarPremios();
        });
        callBack();
    });
}

function ocultarPremios(){
    $('.premios-fondo').animate({right:'-179px'},300);
}
function mostrarPremios(){
    $('.premios-fondo').animate({right:'0px'},300)
}


$(document).ready(function(){

    $('.premios .solapa').click(function(){
        var r=$('.premios-fondo').css('right');
        if(r=='0px'){
            ocultarPremios();
        }else{
            mostrarPremios();
        }

    });


    $('.icono-1').hover(
        function(){
            $('.tooltip-1').animate({width: '83px', height: '53px'},200);
        },function(){
            $('.tooltip-1').animate({width: '0px', height: '0px'},200);
        }
    );
    $('.icono-2').hover(
        function(){
            $('.tooltip-2').animate({width: '122px', height: '49px'},200);
        },function(){
            $('.tooltip-2').animate({width: '0px', height: '0px'},200);
        }
    );
    $('.icono-3').hover(
        function(){
            $('.tooltip-3').animate({width: '61px', height: '51px'},200);
        },function(){
            $('.tooltip-3').animate({width: '0px', height: '0px'},200);
        }
    );
    $('.icono-4').hover(
        function(){
            $('.tooltip-4').animate({width: '121px', height: '54px'},200);
        },function(){
            $('.tooltip-4').animate({width: '0px', height: '0px'},200);
        }
    );

});
