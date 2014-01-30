<?php


class TwigFunctions extends Controller
{
    public function path($name, $params=array())
    {
        return Core::getInstance()->Router->generate($name, $params);
    }
	
    public function option($name)
    {
        return $this->getFrontRepository()->getOption($name);
    }
	
    public function getContent($content)
    {
        return $this->getFrontRepository()->getContent($content);
    }

    public function getUser()
    {
        if ($this->getService('Security')->getUser()) {
            return $this->getService('Security')->getUser();
        }
        return false;
    }
	
    public function getUserId($id)
    {
        if ($this->getService('Security')->getUserId($id)) {
            return $this->getService('Security')->getUserId($id);
        }
        return false;
    }
	
    public function isActive($path, $arg = false)
    {
        $url = $_SERVER['REQUEST_URI'];

        if (strpos($url, '?') > 0) {
            $url = substr($url, 0, strpos($url, '?'));
        }

        if (substr($url, strlen($url)-1, 1) != '/') {
            $url .= '/';
        }

        if ($arg) {
            $pathUrl = $this->generate($path, $arg);
        } else {
            $pathUrl = $this->generate($path);
        }

        if ($pathUrl ==  $url) {
            return true;
        } else {
            return false;
        }
    }
}
