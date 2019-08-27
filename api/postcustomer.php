<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Method: *");
header("Content-Type:application/json");

// if (($_GET['customerID']) && $_GET['customerID']!="") {
    include('../dbconnection.php');

    //$customerID = $_GET['customerID'];

    $statement = $pdo->prepare(
        "INSERT INTO customer (customer_name, customer_phone, customer_email) 
         VALUES (:customerName, :customerPhone, :customerEmail)"
    );

    $statement->execute([
        ":customer_name"    => $_POST["customerName"],
        ":customer_phone"     => $_POST["customerPhone"],
        ":customer_email"     => $_POST["customerEmail"],
    ]);
   
// }else{
   // response(NULL);
    //}
    
    echo json_encode(["message" => "It works"]);
?>