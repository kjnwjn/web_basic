<?php
class DB
{
    public $conn;
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $dbname = 'project_database';

    function __construct()
    {
<<<<<<< HEAD
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->dbname);
=======
        $this->conn = mysqli_connect($this->host, $this->username, $this->password, $this->dbname);
>>>>>>> d7fc51a10643a9560bcb280b4add131580ba1a22
        mysqli_select_db($this->conn, $this->dbname);
        mysqli_query($this->conn, "SET NAMES 'utf8'");
    }
}
