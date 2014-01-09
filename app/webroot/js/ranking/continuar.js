/**
 * Created by Riter on 8/01/14.
 */
$(document).ready(function(){
    window.parent.$('div.texto-2').html($('.puesto').html());

    $('.boton').click(function(){
        window.parent.$.fancybox.close( );
        return false;
    });

});
