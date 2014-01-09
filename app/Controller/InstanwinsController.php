<?php
/**
 * Created by PhpStorm.
 * User: Riter Angel Mamani Cordova
 * Date: 24-12-13
 * Time: 05:26 PM
 */

class InstanwinsController extends AppController{


    public function add()
    {
        $this->layout = '';
        if ($this->request->is('post')) {
            $datos = $this->request->data;
            if ($this->Ranking->save($datos)) {
                //$this->Session->setFlash('El Pais fue registrada', 'success_message');
                //$this->redirect(array('controller' => 'paises', 'action' => 'index'));
            }
        }
    }

    public function _getGanador($dni=null){
        /* Se obtiene el premio con fecha y hora menor a la Actual*/
        $ganador=$this->Instanwin->find('first',array('conditions'=>array('fecha_salida <='=>date('Y-m-d H:i:s'),'estado'=>'activo')));
        if(!empty($ganador)){
            /* Si es ganador se aactualiza la tupla en Instanwin*/
            $fecha=date('Y-m-d H:i:s');
            $ganador['Instanwin']['estado']='inactivo';
            $ganador['Instanwin']['ganador']=$dni;
            $ganador['Instanwin']['fecha_ganador']=$fecha;
            $ganador['Instanwin']['hash']=md5($fecha);

            if($this->Instanwin->save($ganador)){
                $res['ganador']='Ok';
                $res['premio']=$ganador['Instanwin']['premio'];
                $res['hash']=$ganador['Instanwin']['hash'];
                return $res;
            }
        }
        return array('ganador'=>'noOk');
    }

    public function _sendEmailGandor($email='',$nombre='',$premio=''){
        $adcentralComponent = $this->Components->load('Adcentral');
        //$usuario=$this->Usuario->find('first',array('conditions'=>array('dni'=>$dni)));
        $from = array('haceequipo@equipolasegunda.com.ar' => 'La segunda');
        $to = array($email => $nombre);
        $subject = 'Muchas gracias por tu donación, has sido ganador de un/a '.$premio.'!';
        $params = array(
            'nombre' => $nombre,
            'premio' => $premio
        );
        $adcentralComponent->sendEmail('ganador', $from, $to, $subject, $params);
    }
} 