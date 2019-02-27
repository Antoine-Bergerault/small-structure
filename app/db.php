<?php

class db {

    private $db = false;
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $database = 'main';

    public function loaddb(){
        try{
            $this->db = new \PDO('mysql:host=' . $this->host . '; dbname=' . $this->database, $this->username, $this->password, array(
                \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'/*,
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_WARNING*/
            ));
        }catch(\PDOException $e){
            die('<h1>Cannot connect to database</h1>');
        }
    }

    public function query($sql, $data = array()){
        if($this->db == false){
            $this->loaddb();
        }
        $req = $this->db->prepare($sql);
        $req->execute($data);
        return $req->fetchAll(\PDO::FETCH_OBJ);
    }
    
    public function lastInsertId(){
        return $this->db->lastInsertId();
    }

}



?>