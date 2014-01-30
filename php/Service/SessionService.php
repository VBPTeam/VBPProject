<?php

class SessionService
{
    function __construct(){

    }

   public function setFlash($name,$value, $redirect = null)
   {
       $_SESSION['flash'][$name]['value'] = $value;
       $_SESSION['flash'][$name]['k'] = 0;

       if ($redirect) {
           header('location:'.$redirect);
           exit();
       }
   }

    public  function killFlash(){
        if(isset($_SESSION['flash'])){
        foreach($_SESSION['flash'] as $key => $value){
            if($_SESSION['flash'][$key]['k'] >= 2){
                unset($_SESSION['flash'][$key]);

            }else{
                $_SESSION['flash'][$key]['k']++;
            }
        }
        }
    }

    function __destruct(){
        $this->killFlash();
        //echo 'Session is destructed';
    }

}
