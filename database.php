<?php



class Database extends PDO {
    public $id;
    protected $db;
    public $host = HOST;
    public $dbname = DBNAME;
    public $user = USER;
    public $pass = PASS;
    public function __construct() {
        parent::__construct("mysql:host=$this->host;dbname=$this->dbname", "$this->user", "$this->pass");
    }
}
