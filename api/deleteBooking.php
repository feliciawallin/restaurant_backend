<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: DELETE");
header("Content-Type:application/json");

    include('../dbconnection.php');

    // var_dump($_GET);
    // var_dump($_POST);

    $inputJSON = file_get_contents('php://input');
    $input = json_decode($inputJSON);

    $reservationID = $input->ReservationID;

    $statement = $pdo->prepare("DELETE FROM Reservation WHERE `ReservationID` = '$reservationID'");
    $statement->execute([
        ":reservationID" => $reservationID
    ]);
    
    echo json_encode($statement);
    // echo("Hej");
?>