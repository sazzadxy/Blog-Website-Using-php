<?php
require_once('db/DB.php');

class Account  
{
    private $db;
    public function __construct()
    {
        return $this->db = new DB;
    }

    public function login($username,$password)
    {
        $this->db->query("SELECT username,password FROM users WHERE username = :name AND password = :pass");
        $this->db->bind(':name',$username);
        $this->db->bind(':pass',$password);
        $result = $this->db->resultset();
         if ($this->db->rowCount()>0) {
             $_SESSION['username'] = $_POST['username'];
             header("Location:result.php");
         }

    }

}


?>