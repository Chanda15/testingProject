<?php
class CommonModel
{
    public function __construct()
    {
        $db = new DBConnectionModel;
        $this->conn = $db->conn;
    }

    public function insert($table, $data)
    {
        $columns = implode(",", array_keys($data));
        $values = "'" . implode("','", $data) . "'";
        $sql = "INSERT INTO $table ($columns) VALUES ($values)";
        $result = $this->conn->query($sql);
        if ($result == true) {
            $response = array('status'=>1, 'message'=>'Data is saved successfully.');
        }else{
            $response = array('status'=>0, 'message'=>'Something went wrong!');
        }
        return $response;
    }

    public function update($table, $data, $where)
    {

        // Initialize an empty array to store the key-value pairs as strings
        $parts = [];

        // Iterate over the $data array
        foreach ($data as $key => $value) {
            // Add the key-value pair to the $parts array
            // Use addslashes to escape any single quotes in the value
            $parts[] = "$key='" . addslashes($value) . "'";
        }

        // Join the parts array with ', ' to form the final string
        $set = implode(', ', $parts);


        $conditions = ' 1 ';
        foreach ($where as $key =>$val){
            $conditions .= " and $key = '$val'";
        }
        $sql = "UPDATE $table SET $set WHERE $conditions";
        $result = $this->conn->query($sql);
        if ($result == true) {
            $response = array('status'=>1, 'message'=>'Data is saved successfully.');
        }else{
            $response = array('status'=>0, 'message'=>'Something went wrong!');
        }
        return $response;
    }

    public function numRows($query)
    {        
        $result = $this->conn->query($query) or die(mysqli_error($this->conn));

        if ($result == false) {
            header("Status: 401 error something in query");
            return false;
        }

        $rows = $result->num_rows;

        return $rows;
    }
     public function get($table, $where = []) {
        $sql = "SELECT * FROM $table where 1 ";
        foreach ($where as $key =>$val){
            $sql .= " and $key = '$val'";
        }
        $result = $this->conn->query($sql) or die(mysqli_error($this->conn).'--'.$sql);
        if($result==true){
            $resultAA = $result->fetch_assoc();
            $response = array('status'=>1, 'data'=>$resultAA);
        }else{
            $response = array('status'=>0, 'message'=>'Something went wrong!');
        }
        
        return $response;
    }
   
    public function getData($query)
    {        
        $result = $this->conn->query($query) or die(mysqli_error($this->conn));

        if ($result == false) {
            header("Status: 401 error something in query");
            return false;
        }

        $rows = array();

        while ($row = $result->fetch_array()) {
            $rows[] = $row;
        }

        return $rows;
    }
    public function delete($table, $where = []) {
        $sql = "DELETE FROM $table WHERE 1 ";
        foreach ($where as $key =>$val){
            $sql .= " and $key = '$val'";
        }
        $result = $this->conn->query($sql) or die(mysqli_error($this->conn).'--'.$sql);
        if($result==true){
            $response = array('status'=>1, 'message'=>'Data deleted successfully');
        }else{
            $response = array('status'=>0, 'message'=>'Something went wrong!');
        }
        
        return $response;
    }
}
?>