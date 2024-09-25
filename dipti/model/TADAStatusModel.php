<?php
class TADAStatusModel
{
    public function __construct()
    {
        $this->commonObject = new CommonModel;
    }
    public function getList($start, $length, $search, $orderColumn, $orderDir)
    {
       $query = "SELECT * from tm_ta_da_status where 1 ";

        if ($search!='') {
            $query .= " and (status LIKE '%$search%' OR status_description LIKE '%$search%' ) ";
        }
       
        if($orderColumn!='')
        $query .= " ORDER BY " . $orderColumn . " " . $orderDir;

        // Apply limit for pagination
        $querylist = $query;
        if($length!=''){
            if($length!='-1')
                $querylist .= " LIMIT $start, $length";
        }
        
        $result = $this->commonObject->getData($querylist);
        $queryCount = $query;
        $total = $this->commonObject->numRows($queryCount);
        return array('list'=>$result, 'count'=>$total);
    }
}
?>