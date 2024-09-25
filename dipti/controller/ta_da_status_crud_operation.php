<?php
include('../db/db_connect.php');
include('../model/CommonModel.php');
include('../model/TADAStatusModel.php');
//Start save fuctionality
if(isset($_REQUEST['action']) && $_REQUEST['action']=='save'){
    $data['status'] = $_POST['Status'];
    $data['status_description'] = $_POST['Description'];
    $editId = $_POST['EditId'];
    $objCommomModel = new CommonModel();
    if($editId==''){
        $result = $objCommomModel->insert('tm_ta_da_status', $data);
    }else{
        $where['status'] = $editId;
        $result = $objCommomModel->update('tm_ta_da_status', $data, $where);
    }
    echo json_encode($result);
}
//End save fuctionality

//Start edit fuctionality
if(isset($_REQUEST['action']) && $_REQUEST['action']=='edit'){
    $data['status'] = $_REQUEST['ta_da_status'];
    $objCommomModel = new CommonModel();
    $result = $objCommomModel->get('tm_ta_da_status', $data);
    echo json_encode($result);
}
//End edit fuctionality

//Start List
if(isset($_REQUEST['action']) && $_REQUEST['action']=='list'){
        $start = intval($_POST['start']);
        $length = intval($_POST['length']);
        $search = $_POST['search'];
        if(isset($_POST['order']))
        {
            foreach($_POST['order'] as $order)
            {
                $orderColumn = $order['column'];
                $orderDir = $order['dir'];
            }
        }

        // Define columns for ordering
        $columns = array(
            0 => 'status',
            1 => 'status',
        );
        
        // End Code :Start and End limit Offest by datatable
        $search = $search['value'] ?: '';
        $orderColumn = $columns[$orderColumn];
        $objTADAStatusModel = new TADAStatusModel();
        $result = $objTADAStatusModel->getList($start, $length, $search, $orderColumn, $orderDir);
        $list = $result['list'];
        $total = $result['count'];

        $dataArray=array();
        foreach($list as $row)
        {
            $status = $row['status'];
            $value['status'] = $status;
            $value['status_description'] = $row['status_description'];
            //$value['edit'] = 'status_data.php?action=edit&status='.$row['status'];
            $dataArray[]=$value;
        }

        $temp=array("draw"=>$_REQUEST['draw'],"recordsTotal"=>$total,"recordsFiltered"=>$total,"data"=>$dataArray);

        echo json_encode($temp);
}
//End List
//Start delete fuctionality
if(isset($_REQUEST['action']) && $_REQUEST['action']=='delete'){
    $where['status'] = $_REQUEST['ta_da_status'];
    $objCommomModel = new CommonModel();
    $result = $objCommomModel->delete('tm_ta_da_status', $where);
    echo json_encode($result);
}
//End delete fuctionality
?>