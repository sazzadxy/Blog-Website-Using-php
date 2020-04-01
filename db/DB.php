<?php
require_once('./config/config.php');

class DB
{
    private $host = DB_HOST;
    private $user = DB_USER;
    private $password = DB_PWD;
    private $dbname = DB_NAME;

    private $connection, $error, $stmt, $dbconnected = false;

    public function __construct()
    {
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        $option = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_PERSISTENT => true
        );

        try {
            $this->connection = new PDO($dsn, $this->user, $this->password);
            $this->dbconnected = true;
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            $this->dbconnected = false;
        }
    }

    public function getError()
    {
        return $this->error;
    }

    public function isConnected()
    {
        return $this->dbconnected;
    }

    public function query($query)
    {
        $this->stmt = $this->connection->prepare($query);
        
    }

    public function lastInsertId()
    {
        return  $this->connection->lastInsertId();
    }

    public function execute()
    {
        return $this->stmt->execute();
    }


    public function resultset()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function rowCount()
    {
        return $this->stmt->rowCount();
    }

    public function single()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    public function bind($param, $value, $type = null)
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
                    break;
            }
        }

        $this->stmt->bindValue($param, $value, $type);
    }
}
