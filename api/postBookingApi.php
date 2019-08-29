<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type:application/json");

    include('../dbconnection.php');

    $input = json_decode($inputJSON);

    $date = $input->date;
    $guests = $input->guests;
    $time = $input->time;

    $name = $input->name;
    $email = $input->email;
    $phone = $input->phone;

    $statement = $pdo->prepare(
        "INSERT INTO Reservation (Date, Guests, Time) 
         VALUES (:date, :guests, :time)"
    );

    $statement->execute([
        ":date"    => $date,
        ":guests" => $guests,
        ":time" => $time,
    ]);


    $statement = $pdo->prepare(
        "INSERT INTO Customer (Name, Phone, Email) 
         VALUES (:name, :phone, :email)"
    );

    $statement->execute([
        ":name"    => $name,
        ":phone" => $phone,
        ":email" => $emai,
    ]);
    
    echo json_encode($reservations);
?>