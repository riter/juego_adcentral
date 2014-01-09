<?php
App::uses('Component', 'Controller');

class AdcentralComponent extends Component{

    public function sendEmail($template, $from, $to, $subject, $params = null) {
        try{
            App::uses('CakeEmail', 'Network/Email');
            $Email = new CakeEmail($this->configEmail());
            $Email->template($template);
            $Email->emailFormat('html');
            $Email->from($from);
            $Email->to($to);
            //$Email->replyTo(array());
            $Email->subject($subject);
            if($params != null){
                $Email->viewVars($params);
            }
            $Email->send();
            return true;

        }catch (Exception $e){
            CakeLog::debug(print_r($e->getMessage(),true));
            return false;
        }
    }
    public function configEmailServer() {
        $gmail = array(
            'transport' => 'Smtp',
            'from' => array('haceequipo@equipolasegunda.com.ar' => 'La segunda'),
            'host' => 'ssl://server.smla.co',
            'port' => 465,
            'timeout' => 10,
            'username' => 'haceequipo@equipolasegunda.com.ar',
            'password' => 'vC_qG;#XOp6{',
            'client' => null,
            'log' => true,
            'emailFormat' => 'html'
        );
        return $gmail;
    }

    public function configEmail() {
        $gmail = array(
            'transport' => 'Smtp',
            'from' => array('riter.angelito@gmail.com' => 'La segunda'),
            'host' => 'ssl://smtp.gmail.com',
            'port' => 465,
            'timeout' => 10,
            'username' => 'riter.angelito@gmail.com',
            'password' => 'riterangel',
            'client' => null,
            'log' => true,
            'emailFormat' => 'html'
        );
        return $gmail;
    }
}