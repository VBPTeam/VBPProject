<?php


Class Model
{
    protected static $Instance = null;
    public $DB;

    public static function getInstance()
    {
        if(self::$Instance == null)
            self::$Instance = new Model;
        return self::$Instance;
    }

    private function __construct(){
        $pr = Spyc::YAMLLoad('config/parameters.yml');
        $this->connect($pr);
    }

    public function connect(Array $pr)
    {
        $host = $pr['database']['host'];
        $dbname = $pr['database']['dbname'];
        $user = $pr['database']['user'];
        $pass = $pr['database']['pass'];
        try {
            $this->DB = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
        }
        catch(PDOException $e) {
            echo $e->getMessage();
        }
        $this->DB->query("SET NAMES 'utf8'");
        $this->DB->query("SET CHARACTER SET 'utf8'");
        $this->DB->query("SET SESSION collation_connection = 'utf8_general_ci'");
    }

    public function __destruct() {
        $this->DB = null;
    }

}