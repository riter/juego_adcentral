function resizeDrum(w){
    if(w<=320){

    }else if(w<=360){

    }else if(w<=480){

    }else if(w<=568){

    }else if(w<=600){

    }else if(w<=640){

    }else if(w<=720){

    }else if(w<=768){

    }else if(w<=800){

    }else if(w<=1367){

    }else{

    }
}
$(window).resize(function() {
    resizeDrum($(window).width());

   // $("#switch p").html('Ancho: '+$(window).width());
});
$(document).ready(function(){
    resizeDrum($(window).width());
});