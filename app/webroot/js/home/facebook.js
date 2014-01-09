/**
 * Created by Riter on 8/01/14.
 */

function FacebookApi(){
    this.init=function(){
        FB.init({
            appId  : '1447665815453245',
            status : true,
            cookie : true,
            frictionlessRequests : true,
            oauth: true
        });
    }

    this.getLoginStatus = function(fnOk, fnNoAutorizado)
    {
        this.isConectado(function(conectado, response)
        {
            if(conectado)
            {
                fnOk(response);
            }
            else
            {
                fnNoAutorizado(response);
            }
        });
    };
    this.isConectado = function(fnCallback)
    {
        FB.getLoginStatus(function(response)
        {
            var isConectado = false;
            if (response.status === 'connected')
            {
                isConectado = true;
            }
            fnCallback(isConectado, response);
        });
    };
    loginFace = function(){

        FB.login(function(response)
            {
                if (response.authResponse)
                {
                    FB.api('/me', function(response)
                    {
                        conectado(response);
                    });
                }
                else
                {
                    noAutorizado(response);
                }
            },
            {
                scope: 'publish_stream, offline_access, read_friendlists'
            });
    };
    conectado = function(){
        console.log('conectado...');
    };
    noAutorizado = function(response)
    {
        alert('No autorizado');
    };
    /* Msi funciones*/
    this.conectar=function(){

        FB.getLoginStatus(function(response)
        {

            if (response.status === 'connected')
            {
                return true;
            }else{
                loginFace();
            }
        });
    }

    this.invitarAmigos=function(){

        FB.ui({method: 'apprequests',
            to:[],
            display:'popup',
            message: 'Participa ahora!. En el concurso Yo lo quiero para Navidad'
        }, this.requestCallback);
    };

    this.postearMuro = function(callback){

        FB.ui({ method: 'feed',
            picture : 'https://equipolasegunda.com.ar/images/lasegunda.jpg',
            link : 'https://equipolasegunda.com.ar/',
            name: 'Hac&eacute; Equipo con La Segunda',
            caption: 'Yo ya jugu\xe9 a Hac\xe9EquipoConLaSegunda, colabor\xe9 con la Fundaci\xF3n Manu Gin\xF3bili y estoy participando por premios incre\xEDbles. Cuantos m\xE1s jugadores seamos, \xA1mejor es el premio! Sumate vos tambi\xe9n. '

        }, callback);
    };

    this.init();
}