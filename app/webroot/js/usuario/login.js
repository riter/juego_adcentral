/**
 * Created by Riter on 8/01/14.
 */
$(document).ready(function(){

    $('#enviar').click(function(){

        $.ajax({
            data: $( "#form_login" ).serialize(),
            url:   "/usuarios/login/",
            type: "POST",
            async:true,
            dataType: "json",
            beforeSend: function(){
                //$("body").append('<div id="fancybox-loading"><div></div></div>');
            },
            success:  function (response) {
                //$("#fancybox-loading").remove();

                var datos=eval(response);
                console.log(response);

                if(datos.msg=='Ok'){
                    console.log('se envio correctamente'+datos.puesto);
                    window.parent.$('div.texto-2').html(datos.puesto);
                }else{
                    console.log('error al enviar');
                }
                window.parent.$.fancybox.close( );
            }
        });
        return false;
    });
    $('#registrarse').click(function(){
        window.parent.$.fancybox.close( );
        return false;
    });

});
