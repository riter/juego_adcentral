<?php
/**
 * Created by PhpStorm.
 * User: Riter Angel Mamani Cordova
 * Date: 24-12-13
 * Time: 05:26 PM
 */

class CompartirsController extends AppController{

    public function ajax_compartir_email(){
        try{
            //$email=$this->request->data['email'];
            //$name=$this->request->data['nombre'];

            $email='riter.cordova@gmail.com';
            $name='riter prueba';

            $adcentralComponent = $this->Components->load('Adcentral');

            $from = array('haceequipo@equipolasegunda.com.ar' => 'La segunda');
            $to = array($email => $name);
            $subject = $name.' te invita a jugar con Manu Ginobili';
            $params = array(
                'nombre' => $name
            );
            $send=$adcentralComponent->sendEmail('invitar', $from, $to, $subject, $params);

            $res=$send?array('msg'=>'Ok'):array('msg'=>'noOk');

        }catch (Exception $e){
            CakeLog::debug(print_r($e->getMessage(),true));
            $res=array('msg'=>'noOk');
        }

        echo json_encode($res);
        $this->autoRender=false;
    }
    public function ajax_compartio(){
        $this->layout = '';

        $user=$this->Session->read('usuario');

        $compartir=$this->Compartir->find('first',array('conditions'=>array('dni'=>$user['dni'],'fecha'=>date('Y-m-d'))));
        if(!empty($compartir)){
            /* Ya compartio este dia*/
            echo 'Ok';
        }else{
            echo 'noOk';
        }
        $this->autoRender=false;
    }
    public function ajax_compartir($medio=null)
    {
        $this->loadModel('Usuario');
        $this->layout = '';

        $user=$this->Session->read('usuario');

        $res=array('msg'=>'noOk','ganador'=>'noOk');

        $datos=array('Compartir'=>array('dni'=>$user['dni'],'medio'=>$medio,'fecha'=>date('Y-m-d')));

        if ($this->Compartir->save($datos)) {

            $res['msg']='Ok';

            //$compartir=new
            $compartir=$this->Compartir->find('count',array('group' => 'id'));
            $res['compartir']=substr('000000',6-strlen($compartir)).$compartir;

            App::import('Controller', 'Instanwins');
            $instanwin=new InstanwinsController();

            /* Si es ganador actualiza las tablas*/
            $ganador=$instanwin->_getGanador($user['dni']);

            if($ganador['ganador']=='Ok'){
                /*Se envia un email al ganador*/
                $usuario=$this->Usuario->find('first',array('conditions'=>array('dni'=>$user['dni'])));
                $instanwin->_sendEmailGandor($usuario['Usuario']['email'],$usuario['Usuario']['nombre'],$ganador['premio']);

                $res=array_merge($res,$ganador);
            }
        }

        echo json_encode($res);
        $this->autoRender=false;
    }

    public function invitar_email(){
        $this->layout='';
        $res=array('msg'=>'noOk');

        if ($this->request->is('post')) {
            $datos=$this->request->data;
            try{
                $adcentralComponent = $this->Components->load('Adcentral');
                $from = array('haceequipo@equipolasegunda.com.ar' => 'La segunda');

                for($i=0; $i<=3; $i++){
                    $to = array($datos['email'.$i] => $datos['nombre'.$i]);
                    $subject = $datos['nombre'.$i].' te invita a jugar con Manu Ginobili';
                    $params = array(
                        'nombre' => $datos['nombre'.$i]
                    );
                    $send=$adcentralComponent->sendEmail('invitar', $from, $to, $subject, $params);
                    $res=$send?array('msg'=>'Ok'):array('msg'=>'noOk');
                }

            }catch (Exception $e){
                CakeLog::debug(print_r($e->getMessage(),true));
            }
            echo json_encode($res);
            $this->autoRender=false;
        }
    }

    public function invitar(){
        $this->layout='';
    }

    public function ganaste($premio=null,$hash=null){
        $this->layout='';
        if ($this->request->is('get')) {
            $this->set('premio',$premio);
            $this->set('hash',$hash);
        }
    }

    public function compartiste($premio=null,$hash=null){
        $this->layout='';

    }
} 