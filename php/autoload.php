<?php


 /*spl_autoload_register( function($className){
    $className = preg_replace('[\\\]','/',$className);
    echo $className;
    require_once 'php/'.$className.'.php';
});*/



/*function __autoload($className){
    $className = preg_replace('[\\\]','/',$className);
    echo $className;
    require_once 'php/'.$className.'.php';
}*/

define('PATH', $_SERVER['DOCUMENT_ROOT']);

require 'Router.php';
require 'Core.php';
require 'Model.php';
require 'View.php';
require 'Spyc.php';
require 'BaseController.php';
require 'src/Controller/Controller.php';
require 'src/Controller/TwigFunctions.php';