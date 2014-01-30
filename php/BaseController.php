<?php

class BaseController
{
    private static $Services = array();
    private static $Controllers = array();
    private static $Modules = array();
    private static $optionsArray = null;
    private static $trans = null;

    public function getLang()
    {
        return $this->getOptions('default_lang');
    }

    public function getTrans($value)
    {
        if (!self::$trans) {
            self::$trans = Spyc::YAMLLoad('src/Lang/'.$this->getLang().'.yml');
        }
        return self::$trans[$value];
    }

    public function getOptions($optionName){
        if (!self::$optionsArray) {
            self::$optionsArray = Spyc::YAMLLoad('config/options.yml');
        }

        return self::$optionsArray[$optionName];
    }

    function getService($serviceName)
    {
        if(!isset(self::$Services[$serviceName])){
            $serviceName .= 'Service';
            require_once PATH.'/php/Service/'.$serviceName.'.php';
            self::$Services[$serviceName] = new $serviceName;
        }
        return self::$Services[$serviceName];
    }

    public function getController($controllerName)
    {
        if ( !isset(self::$Controllers[$controllerName]) ) {
            $controllerName .= 'Controller';
            require_once PATH.'/src/Controller/'.$controllerName.'.php';
            self::$Controllers[$controllerName] = new $controllerName;
        }
        return self::$Controllers[$controllerName];
    }

    public function getModule($moduleName)
    {
        if ( !isset(self::$Modules[$moduleName]) ) {
            $moduleName .= 'Module';
            require_once PATH.'/src/Module/'.$moduleName.'.php';
            self::$Modules[$moduleName] = new $moduleName;
            return self::$Modules[$moduleName];
        }
        return $this->Modules[$moduleName];
    }

    public function redirect($page)
    {
        header('location:'.$page);
        exit();
    }

    public function getUser()
    {
        return $this->getService('Security')->getUser();
    }

    public function generate($name, $params = array())
    {
        return Core::getInstance()->Router->generate($name, $params);
    }

    public function render($tplName, $opt = array())
    {
        return $this->getService('Templates')->render($tplName, $opt);
    }
}