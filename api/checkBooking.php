<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type:application/json");

    include('../dbconnection.php');

    $date = $_GET["bookingDate"];
    $time = $_GET["bookingTime"];
    $numberOfGuests = $_GET["bookingNumberOfGuests"];

    $statement = $pdo->prepare("SELECT `Date` FROM `Reservation` WHERE Date = $date AND Time = $time");
    $statement->execute();
    $reservations = $statement->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($reservations);
?>