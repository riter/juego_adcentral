<?php
/**
 * Created by PhpStorm.
 * User: Riter Angel Mamani Cordova
 * Date: 24-12-13
 * Time: 05:26 PM
 */

class RankingsController extends AppController{


    public function ajax_add($tiempo=null)
    {
        $this->layout = '';
        /*$res['msg']='noOk';
        $newTime=substr($tiempo,0,strlen($tiempo)-3);

        if ($this->request->is('get')) {
            $usuario=$this->Session->read('usuario');
            $ranking=$this->Ranking->find('first',array('conditions'=>array('dni'=>$usuario['dni'])));

            if(!empty($ranking)){

                if ( $newTime >= $ranking['Rankings']['tiempo']){
                    $ranking['Ranking']['tiempo']=$newTime;
                    $ranking['Ranking']['fecha']=date('Y-m-d');
                    $this->Ranking->save($ranking);
                }

                $puesto=new Ranking();
                $res['dni']=$usuario['dni'];
                $res['puesto']=$puesto->getPuesto($usuario['dni']);
                $res['msg']='Ok';

                $this->set('puesto',$res['puesto']);
            }
            $this->set('tiempo',$newTime);
            echo json_encode($res);
            $this->autoRender=false;
        }*/
    }
    public function continuar($tiempo=null){
        $this->layout = '';
        $res['msg']='noOk';
        $newTime=substr($tiempo,0,strlen($tiempo)-3);

        if ($this->request->is('get')) {
            $usuario=$this->Session->read('usuario');
            $ranking=$this->Ranking->find('first',array('conditions'=>array('dni'=>$usuario['dni'])));

            if(!empty($ranking)){

                if ( $newTime >= $ranking['Ranking']['tiempo']){
                    $ranking['Ranking']['tiempo']=$newTime;
                    $ranking['Ranking']['fecha']=date('Y-m-d');
                    $this->Ranking->save($ranking);
                }

                $puesto=new Ranking();
                $res['dni']=$usuario['dni'];
                $res['puesto']=$puesto->getPuesto($usuario['dni']);
                $res['msg']='Ok';

                $this->set('puesto',$res['puesto']);
            }
            $this->set('tiempo',$newTime);
        }
    }
} 