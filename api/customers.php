<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type:application/json");

// if (($_GET['customerID']) && $_GET['customerID']!="") {
    include('../dbconnection.php');

    //$customerID = $_GET['customerID'];

    $statement = $pdo->prepare("SELECT * FROM `customer`");
    $statement->execute();
    $customer = $statement->fetchAll(PDO::FETCH_ASSOC);
// }else{
   // response(NULL);
    //}
    
    echo json_encode($customer);
?>