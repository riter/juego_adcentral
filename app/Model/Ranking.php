<?php
/**
 * Created by PhpStorm.
 * User: Luis Miguel Torrico
 * Date: 24-10-13
 * Time: 05:26 PM
 */

class Ranking extends AppModel {
    public $name = 'Ranking';
    var $useTable = 'ranking';
    public $primaryKey = 'id';

    public function getPuesto($dni=null){
        $puesto=1;
        $datos=$this->find('all',array('order'=>array('tiempo desc')));

        foreach($datos as $ranking){
            if ($ranking['Ranking']['dni'] == $dni){
                return $puesto;
            }
            $puesto++;
        }
    }
} 