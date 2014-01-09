<?php
/**
 * Created by PhpStorm.
 * User: Riter Angel Mamani Cordova
 * Date: 24-12-13
 * Time: 05:26 PM
 */

class UsuariosController extends AppController{


    public function index()
    {
        $this->layout = '';
        if ($this->request->is('post')) {
            $res['msg']='noOk';
            try{
                $datos = $this->request->data;

                $fecha=$datos['Usuario']['fecha_nacimiento'];
                $datos['Usuario']['fecha_nacimiento']=$fecha['year'].'-'.$fecha['month'].'-'.$fecha['day'];

                $datos['Usuario']['bases']=$datos['Usuario']['bases']=='1'?'SI':'NO';
                $datos['Usuario']['fecha']=date('Y-m-d H:i:s');
                $datos['Usuario']['chances']='3';

                $user=$this->Usuario->find('first',array('conditions'=>array('dni'=>$datos['Usuario']['dni'])));
                if(!empty($user)){
                    // Ud ya esta registrado
                    CakeLog::debug(print_r('Ud ya estas registrado',true));
                    $res['msg']='registrado';
                }else{
                    $usuario=$this->Usuario->save($datos);
                    if ($usuario) {
                        //Se registro correctamente
                        CakeLog::debug(print_r('Se registro correctamente',true));

                        /* Obtiene puesta en ranking y guarda el login*/
                        $this->loadModel('Ranking');
                        $rankingD=array('Ranking'=>array('dni'=>$usuario['Usuario']['dni'],'tiempo'=>'00-00','fecha'=>date('Y-m-d')));
                        $ranking=new Ranking();
                        $ranking->save($rankingD);
                        $res['email']=$usuario['Usuario']['email'];
                        $res['dni']=$usuario['Usuario']['dni'];
                        $res['puesto']=$ranking->getPuesto($usuario['Usuario']['dni']);
                        $this->Session->write('usuario',$res);

                        $res['msg']='Ok';
                    }
                }

            }catch (Exception $e){
                CakeLog::debug(print_r($e->getMessage(),true));
            }
            echo json_encode($res);
            $this->autoRender=false;
        }else{
            $this->set('dias',$this->_getSelectFecha(1,31));
            $this->set('meses',$this->_getSelectFecha(1,12));
            $this->set('años',$this->_getSelectFecha(1945,1995));
        }
    }

    public function _getSelectFecha($minValor=null,$maxValor=null){
        $res=array();
        for($c=$minValor; $c<=$maxValor; $c++){
            $res[$c]=$c;
        }
        return $res;
    }
    public function login(){
        $this->layout='';
        $res['msg']= 'noOk';

        if ($this->request->is('post')) {
            $datos = $this->request->data;
            $user=$this->Usuario->find('first',array('conditions'=>array('dni'=>$datos['Usuario']['dni'])));
            if(!empty($user)){
                /* Obtiene puesta en ranking y guarda el login*/
                $this->loadModel('Ranking');
                $ranking=new Ranking();
                $res['dni']=$user['Usuario']['dni'];
                $res['email']=$user['Usuario']['email'];
                $res['puesto']=$ranking->getPuesto($user['Usuario']['dni']);
                $this->Session->write('usuario',$res);

                CakeLog::debug(print_r('logeo correctamente'.$res['dni'].'puesto:'.$res['puesto'],true));
                $res['msg'] = 'Ok';

            }
            echo json_encode($res);
            $this->autoRender=false;
        }
    }
    public function ajax_islogin(){
        $res['msg']='noOk';
        if($this->Session->check('usuario')){
            $res['msg']='Ok';
        }
        echo json_encode($res);
        $this->autoRender=false;
    }
} 