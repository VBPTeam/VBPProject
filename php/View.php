<?php

class View
{
    private static $Instance = null;
    private $twig;

    public static function getInstance(){
        if(self::$Instance == null)
            self::$Instance = new View;
        return self::$Instance;
    }

    private function __construct(){

    }

    public function init(){
        require_once'Twig/Autoloader.php';
        Twig_Autoloader::register();
        $loader = new Twig_Loader_Filesystem(PATH.'/src/tpl/');
        $this->twig = new Twig_Environment($loader, array(
            'cache' => 'php/cache',
            'autoescape' => false,
            'auto_reload' => true
        ));

        $this->twig->addGlobal('func', new TwigFunctions());
    }

    public function loadTemplate($tplName)
    {
        return $this->twig->loadTemplate($tplName);
    }

    function __destruct(){
       // echo 'View is destructed!';
    }

}
