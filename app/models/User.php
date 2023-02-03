<?php

class User
{


    public $id_user;
    public $first_name ;
    public $last_name ;
    public $phone ;
    public $token;

    private $table = 'user';


    private $conn;
    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function addUser()
    {
        
        $query = 'INSERT INTO ' . $this->table . ' (`first_name`, `last_name`, `phone`,`token`) VALUES (:first_name,:last_name,:phone,:token)';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':first_name', $this->first_name);
        $stmt->bindParam(':last_name', $this->last_name);
        $stmt->bindParam(':phone', $this->phone);
        $stmt->bindParam(':token', $this->token);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    // public function User(){
    //     $query = 'SELECT '
    // }
}
