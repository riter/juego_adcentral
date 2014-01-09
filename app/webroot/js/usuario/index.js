/**
 * Created by Riter on 8/01/14.
 */
$(document).ready(function(){

    $('#enviar').click(function(){

        $.ajax({
            data: $( "#form_usuarios" ).serialize(),
            url:   "/usuarios/index/",
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

                switch (datos.msg){
                    case 'registrado':console.log('ud ya esta registrado');
                        break;
                    case 'Ok':console.log('se envio correctamente');
                        window.parent.$('div.texto-2').html(datos.puesto);
                        window.parent.$.fancybox.close( );
                        break;
                    case 'noOk':console.log('error al enviar');
                        break;
                }
            }
        });
        return false;
    });
    $('#registrarse').click(function(){
        //window.parent.openFancy('/usuarios/index');
        //window.parent.$(".fancy").attr('href','/usuarios/index');
        window.parent.$.fancybox.close( );
        //window.parent.$(".fancy").click();
        return false;
    });

});
