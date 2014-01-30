<?php


class TemplatesService {

    public function __construct()
    {
        View::getInstance()->init();
    }

    public function render($tplName,$Ar = Array())
    {
        $tpl = View::getInstance()->loadTemplate($tplName);
        $Ar['domain_name'] = 'http://'.$_SERVER['SERVER_NAME'];
        $url = $_SERVER['REQUEST_URI'];
        if (substr($url, strlen($url)-1, 1) != '/') {
            $url .= '/';
        }
        $Ar['path'] = $url;

        if (!empty($_SESSION['flash'])) {
            $ArFlash['flash'] = $_SESSION['flash'];
        } else {
            $ArFlash = Array();
        }

        $langAr = array();
        if (isset($_SESSION['lang'])) {
            //$lang = $_SESSION['lang'];
            $lang = 'ru';
            $langAr = Spyc::YAMLLoad('src/Lang/'.$lang.'.yml');
        }

        $finalAr = array_merge($Ar,$ArFlash);
        $finalAr = array_merge($finalAr, $langAr);


        ob_start();
        echo $tpl->render($finalAr);
        $output = ob_get_clean();

        return $output;
    }
}
