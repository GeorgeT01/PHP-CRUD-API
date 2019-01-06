<?php 
class DbConnect
{
    private $conn;

    function connect()
    {
        //Including the constants.php file to get the database constants
        include_once dirname(__FILE__) . '/constants.php';
        //connecting to mysql database
        $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    if (mysqli_connect_errno()) 
    {

        die("Connection failed"); // mysqli_connect_error()
   		exit();
    }
        //finally returning the connection link 
        return $this->conn;
    }
 
}
?>