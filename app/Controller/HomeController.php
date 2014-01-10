<?php
/**
 * Created by PhpStorm.
 * User: Riter Angel Mamani Cordova
 * Date: 24-12-13
 * Time: 05:26 PM
 */

class HomeController extends AppController{

    public function index(){
        $this->layout='';
        $this->Session->destroy();

        $this->loadModel('Compartir');
        $compartir=$this->Compartir->find('count',array('group' => 'id'));

        $this->set('compartidos',substr('000000',6-strlen($compartir)).$compartir);

    }
    public function conoce(){
        $this->layout='';
    }
    public function como(){
        $this->layout='';
    }
} 