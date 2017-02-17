<?php

require("Conn.php");
require("MySQLDao.php");
    
$user_name = htmlentities($_POST["user_name"]);
$password = htmlentities($_POST["password"]);
$returnValue = array();

if(empty($user_name)) {
    $returnValue["status"] = "Error";
    $returnValue["message"] = "Missing user name.";
    echo json_encode($returnValue);
    return;
}
    
if(empty($password)) {
    $returnValue["status"] = "Error";
    $returnValue["message"] = "Missing password for " . $user_name . ".";
    echo json_encode($returnValue);
    return;
}
    
#$secure_password = md5($password);

$dao = new MySQLDao();
$dao->openConnection();
$loginDetails = $dao->getUserDetailsWithPassword($user_name,$password);

if(!empty($loginDetails)) {
    $returnValue["status"] = "Success";
    $returnValue["message"] = "User logged in successfully.(" . $user_name . ":" . $password . ")";
    echo json_encode($returnValue);
} else {
    $returnValue["status"] = "Error";
    $returnValue["message"] = "Invalid username or password specified (" . $user_name . ":" . $password . ")";
    echo json_encode($returnValue);
}
$dao->closeConnection();

?>
