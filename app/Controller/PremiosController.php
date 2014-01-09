<?php
/**
 * Created by PhpStorm.
 * User: Riter Angel Mamani Cordova
 * Date: 24-12-13
 * Time: 05:26 PM
 */

class PremiosController extends AppController{

    public function index(){
        $this->layout='';

        debug(date('Y-m-d H:i:s'));
        $this->autoRender=false;
    }
} 