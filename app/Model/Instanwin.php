<?php
/**
 * Created by PhpStorm.
 * User: Luis Miguel Torrico
 * Date: 24-10-13
 * Time: 05:26 PM
 */

class Instanwin extends AppModel {
    public $name = 'Instanwin';
    var $useTable = 'instanwin';
    public $primaryKey = 'id';


    public function getGanador($dni=null){
        $ganador=$this->find('first',array('conditions'=>array('fecha_salida <='=>date('Y-m-d H:i:s'),'estado'=>'activo')));
        if(!empty($ganador)){
            /* Si es ganador se aactualiza la tupla en Instanwin*/
            $fecha=date('Y-m-d H:i:s');
            $ganador['Instanwin']['ganador']=$dni;
            $ganador['Instanwin']['fecha_ganador']=$fecha;
            $ganador['Instanwin']['hash']=md5($fecha);

            if($this->save($ganador)){
                $res['ganador']='Ok';
                $res['premio']=$ganador['Instanwin']['premio'];
                $res['hash']=$ganador['Instanwin']['ganador'];
                return $res;
            }
        }
        return array('ganador'=>'noOk');
    }
} 