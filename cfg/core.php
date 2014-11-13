<?php
define('PATH_CFG','cfg/');
define('PATH_CLS','cls/');
function __autoload($class_name){
    require_once('cls/'.$class_name.'.php');
}
?>