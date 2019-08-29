<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type:application/json");

    include('../dbconnection.php');

    $inputJSON = file_get_contents('php://input');

    $input = json_decode($inputJSON);
    $date = $input->date;
    $time = $input->time;

    $statement = $pdo->prepare("SELECT `Date` FROM `Reservation` WHERE Date = $date AND Time = $time");
    $statement->execute();
    $reservations = $statement->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($reservations);
?>