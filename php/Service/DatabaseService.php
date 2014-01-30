<?php


class DatabaseService{

    private static $Repositories = array();


    public function __construct(){}

    public function getRepository($repositoryName)
    {
        $repositoryName .= 'Repository';
        if ( !isset(self::$Repositories[$repositoryName])) {
            require_once PATH.'/src/Repository/'.$repositoryName.'.php';
            self::$Repositories[$repositoryName] = new $repositoryName;
        }

        return self::$Repositories[$repositoryName];
    }

    /**
     * @return \PDO
     */
    public function getConnection()
    {
        return Model::getInstance()->DB;
    }

    /**
     * @return \PDOStatement
     */
    public function prepare($sql)
    {
        return $this->getConnection()->prepare($sql);
    }
}
