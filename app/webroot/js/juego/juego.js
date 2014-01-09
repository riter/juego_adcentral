/**
 * Created by Riter on 3/01/14.
 */

/*Class Mano*/
function ClassMano(posX,posY,radio){
    this.posX=posX;
    this.posY=posY;
    this.radio=radio;

    this.img= new Image();
    this.img.src = "js/juego/sprites/"+'mano.png';

    this.pintar=function(canvas){
        if(this.img != undefined){
            canvas.drawImage(this.img, 0, 0,this.img.width,this.img.height,this.posX-(75), this.posY-68, this.img.width, this.img.height);
        }
    }
}
/*Class Pelota*/
function ClassPelota(posX,posY,radio){
    this.posX=posX;
    this.posY=posY;
    this.radio=radio;
    this.gravedad=0;
    this.frame=0;
    this.limiteTope=0;
    this.vy=0;
    this.images=['Image 19','Image 21','Image 23','Image 25','Image 27','Image 29','Image 31','Image 33','Image 35',
        'Image 37','Image 39','Image 41','Image 43','Image 45','Image 47','Image 49','Image 51','Image 53',
        'Image 55','Image 57','Image 59','Image 61','Image 63','Image 65','Image 67','Image 69','Image 71'];

    this.pelota=[];

    /*Funcion que carga las imagenes del Sprite Pelota*/
    this.loadingImage = function () {

        for (var i = 0; i < this.images.length; i++) {
            var img = new Image();
            img.src = "js/juego/sprites/"+this.images[i] + ".png";
            this.pelota[i] = img;
        }

    };

    /* Devuelve la imagen siguiente del Sprite*/
    this.nextImage=function(){
        this.frame=(this.frame+1) % this.images.length;
        return this.pelota[this.frame];
    };

    this.pintar=function(canvas){
        var img=this.nextImage();
        if(img != undefined){
            canvas.drawImage(img, 0, 0,img.width, img.height, this.posX-this.radio, this.posY-this.radio, this.radio*2, this.radio*2);
        }
    };

    /*Aplica gravedad para que caiga*/
    this.aplicargravedad=function() {
        this.vy+=this.gravedad;
        this.posY+=this.vy;

        if((this.posY - this.radio) >= this.limiteTope){
            this.posY = this.posY + this.radio + 10;
            this.vy=0;
            stop();
        }
    }
}

/* Clase Tiempo*/
function Tiempo(){
    this.ms=0;
    this.seg=0;
    this.min=0;
    this.stop=false;

    this.getTime=function(){
        if(!this.stop){
            this.avanzar();
        }
        return this.toStr(this.min)+'-'+this.toStr(this.seg)+'-'+this.toStr(this.ms);
    }

    this.reset=function(){
        this.ms=0;
        this.seg=0;
        this.min=0;
    }

    this.toStr = function(dato){
        if(dato<10){
            return '0'+dato;
        }
        return dato;
    }
    this.avanzar=function(){
        this.ms+=1;
        if(this.ms==100){
            this.ms=0;
            this.seg+=1;
        }
        if(this.seg==60){
            this.seg=0;
            this.min+=1;
        }

    }
}

/* Clase Vector*/
function Vector(posX, posY){
    this.x=parseFloat(posX);
    this.y=parseFloat(posY);
}

/*Manejo de Vectores*/
function unificarVector(v){
    return new Vector(v.x*0.08, v.y*0.03);
}

function sumarVector(v1,v2){
    return new Vector(v1.x+v2.x,v1.y+v2.y);
}
function Coord_Vector(posX1,posY1,posX2,posY2){
    return new Vector(posX2-posX1,posY1-posY2);
}
function Vector_Coord(v){
    return new Vector(v.x,canvas.height - v.y);
}

/* contenido del juego*/
var canvas = null;
var pelota=new ClassPelota(290,160,90);
var ctx=null;
var mano=new ClassMano(280,225,10);
var jugando=false;
var callbackStop=null;

function onload() {
    canvas = document.getElementById('gameCanvas');
    ctx = canvas.getContext("2d");

    pelota.limiteTope=canvas.height;
    pelota.gravedad=0.001;
    pelota.loadingImage();

    mano.pintar(ctx);
}

/* Onload Juego*/
function stop(){
    jugando=false;
    mano.posX=280;
    mano.posY=225;
    mano.pintar(ctx);

    //btn_comenzar();
    timer.stop=true;
    /*llamar pantalla continuar*/
    if(callbackStop!=null){
        callbackStop(timer.getTime());
    }

    timer.reset();
}

var timer=new Tiempo();

function btn_comenzar(){
    $(document).ready(function(){
        $('body').css('cursor','auto');

        mensajeComenzar(function(){
            comenzar();
            $('body').css('cursor','none');
            timer.stop=false;
            setInterval( function(){
                $('.tiempo span:nth-child(1)').html(timer.getTime().substr(0,2));
                $('.tiempo span:nth-child(2)').html(timer.getTime().substr(3,2));
                $('.tiempo span:nth-child(3)').html(timer.getTime().substr(6,2));
            }, 1000/30 );

        });
    });
}

function comenzar(){
    jugando=true;
    pelota.posX=285;
    pelota.posY=160;

    mano.posX=280;
    mano.posY=225;
}

function repaint() {

    if((ctx != null) && (jugando)){
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        pelota.aplicargravedad();
        detectarColPlataformas();
        mano.pintar(ctx);
        pelota.pintar(ctx);
    }
}

/*
function getMousePos(canvas, evt) {
    var rect = canvas.getBoundingClientRect();
    return {
        x: evt.clientX - rect.left,
        y: evt.clientY - rect.top
    };
}*/

/*Detecta colision entre dos objetos*/
function hit(a,b){
    var r = a.radio + b.radio;
    var dx = a.posX - b.posX;
    var dy = a.posY - b.posY;
    return r * r > (dx * dx + dy * dy);
}

function detectarColPlataformas(){

    if(hit(mano,pelota)){
        var p1=Coord_Vector(0,canvas.height,mano.posX,mano.posY);
        var p2=Coord_Vector(0,canvas.height,pelota.posX,pelota.posY);
        var vcol=Coord_Vector(mano.posX,mano.posY,pelota.posX,pelota.posY);

        vcol=unificarVector(vcol);

        var vp=Coord_Vector(0,canvas.height,pelota.posX,pelota.posY);
        var nvp=sumarVector(vp,vcol);
        var nc=Vector_Coord(nvp);
        pelota.posX=nc.x;
        pelota.posY=nc.y;
    }
}
$(document).ready(function(){

    onload();

    setInterval( repaint, 1000 / 60 );

    $(window).bind('mousemove touchmove', function(jQueryEvent) {
        jQueryEvent.preventDefault();
        var event = window.event;
        var newx;

        if(jQueryEvent.pageX == undefined){
            newx=event.touches[0].pageX;
        }else{
            newx=jQueryEvent.pageX;
        }

        var w=$(window).width();
        var xp=(newx/w);

        mano.posX=200+(250*xp);
    });

});

