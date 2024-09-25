<?php
$url = "https://sphm.co.in:8042/METIS/";
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASSWORD','Swarna@142');
define('DB_DATABASE','mfi_uat');
define('DB_PORT',3307);

class DBConnectionModel
{
    public function __construct()
    {
        $conn = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE,DB_PORT);

        if($conn->connect_error)
        {
            die ("<h1>Database Connection Failed</h1>");
        }
        //echo " Database Connected Successfully";
        return $this->conn = $conn;
    }
}

?>