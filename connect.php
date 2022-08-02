<?php

class Database{

    private $host = "localhost";
    private $username = "root";
    private $password ="";
    private $db = "facebook";

    function connect_db(){

        $connection = mysqli_connect($this->host, $this->username, $this->password, $this->db);
        return $connection;

    }

    function read($query){

        $connectionn= $this->connect_db();
        $result = mysqli_query($connectionn,$query);
        if(!$result ){
            return false;
        } else{
            $data = false;
            while($row = mysqli_fetch_assoc($result))
            {

                $data[] =$row;
            }
            return $data;
        }


    }
    function save($query){

        $connectionn= $this->connect_db();
        $result = mysqli_query($connectionn,$query);
        if(!$result){
            return false;
        } else{
            return true;
        }

    }

}

//$DB = new Database();

//$query= "select * from users";
//$data=$DB->read($query);
//$DB->read($query);
//$DB->save($query);
////echo "<pre>";
////print_r($data);
////echo "</pre>";