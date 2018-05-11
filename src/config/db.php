<?php

class db{
    //Properties
    private $dbhost = 'localhost';
    private $dbuser = 'root';
    private $dbpass = '';
    public $dbname = 'demowms';

    //Connect
    public function connect(){
        $mysql_connect_str = "mysql:host=$this->dbhost;dbname=$this->dbname";
        $dbConnection = new PDO($mysql_connect_str, $this->dbuser, $this->dbpass);
        $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $dbConnection;
    }

    //create new DB

    public function create($string){
      try {

        $dbh = new PDO("mysql:host=$this->dbhost", $this->dbuser, $this->dbpass);
        $dbh->exec($string);

        return "success";

      } catch (PDOException $e) {
        return ("DB ERROR: ". $e->getMessage());
      }
    }
}
