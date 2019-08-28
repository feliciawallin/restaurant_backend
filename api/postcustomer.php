<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include('../dbconnection.php');

    $inputJSON = file_get_contents('php://input');

    $input = json_decode($inputJSON);

    $name = $input->customerName;
    $email = $input->customerEmail;
    $phone = $input->customerPhone;

    $statement = $pdo->prepare(
        "INSERT INTO Customer (Name, Phone, Email) 
         VALUES (:name, :phone, :email)"
    );

    $statement->execute([
        ":name"    => $name,
        ":phone"     => $phone,
        ":email"     => $email,
    ]);     
?>