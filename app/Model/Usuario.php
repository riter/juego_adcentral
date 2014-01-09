<?php
/**
 * Created by PhpStorm.
 * User: Luis Miguel Torrico
 * Date: 24-10-13
 * Time: 05:26 PM
 */

class Usuario extends AppModel {
    public $name = 'Usuario';
    var $useTable = 'usuarios';
    //var $displayField = 'descripcion';
    public $primaryKey = 'id';
} 