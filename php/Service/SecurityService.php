<?php



class SecurityService extends Controller
{
    private $User = null;
    private $site = '';

    public function __construct()
    {
        $ar = Spyc::YAMLLoad('config/parameters.yml');
        $this->site = $ar['site'];

        if(isset($_COOKIE['uid']) && isset($_COOKIE['hash'])){

            $user = $this->getFrontRepository()->checkUserByUidAndHash($_COOKIE['uid'],$_COOKIE['hash']);
            if ($user) {
                $this->User = $user;
            } else {
                unset($_COOKIE['hash']);
                unset($_COOKIE['uid']);
                setcookie('uid', '', time()-60*24*30*12, '/',$this->site);
                setcookie('hash', '', time()-60*24*30*12, '/',$this->site);
            }

        }
    }
	
    public function login($user)
    {
        $this->User = $user;

        $this->getFrontRepository()->updateLatestTime($user['uid'],$user['hash']);

        setcookie('uid', $user['uid'], time()+60*24*30*12, '/',$this->site);
        setcookie('hash', $user['hash'], time()+60*24*30*12, '/',$this->site);
    }
	
    public function logout()
    {
        unset($_COOKIE['hash']);
        unset($_COOKIE['uid']);
        setcookie('uid', '', time()-60*24*30*12, '/',$this->site);
        setcookie('hash', '', time()-60*24*30*12, '/',$this->site);
    }

    public function getUser()
    {
        if ($this->User) {
            return $this->User;
        }
        return false;
    }
	
    public function getUserId($id)
    {
        if ($this->getFrontRepository()->getUserId($id)) {
            return $this->getFrontRepository()->getUserId($id);
        }
        return false;
    }

}
