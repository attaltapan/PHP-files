<?php

require("Conn.php");
require("MySQLDaoHospital.php");
    
    $hospital_name = htmlentities($_POST["hospital_name"]);
    $returnValue = array();

    // to get hospital name
    $dao = new MySQLDaoHospital();
    $dao->openConnection();
    $hospital = $dao->getHospitalName($hospital_name);
    $dao->closeConnection();
    
    if(!empty($hospital)) {
        $returnValue["status"] = "Success";
        $returnValue["hospitalName"] = $hospital;
        echo json_encode($returnValue);
    } else {
        $returnValue["status"] = "Error";
        $returnValue["hospitalName"] = "";
        echo json_encode($returnValue);
    }
    
    
?>
