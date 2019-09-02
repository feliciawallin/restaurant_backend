<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type:application/json");

    include('../dbconnection.php');

    $statement = $pdo->prepare("SELECT * FROM `Customer` INNER JOIN `Reservation` ON Customer.CustomerID = Reservation.CustomerID");
    $statement->execute();
    $customer = $statement->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($customer);
?>