<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include('../dbconnection.php');

    $inputJSON = file_get_contents('php://input');

    $input = json_decode($inputJSON);

    $reservationID = $input->ReservationID;
    $time = $input->Time;
    $date = $input->Date;
    $guests = $input->Guests;
    $name = $input->Name;
    $email = $input->Email;
    $phone = $input->Phone;
    $CustomerID = $input->CustomerID;

    var_dump($date);

    // $statement = $pdo->prepare(
    //     "UPDATE `Reservation` 
    //     SET `Date`= '$date', `Guests`= $guests, `Time`= $time
    //     WHERE `ReservationID`= $reservationID"
    // );

    // $statement->execute([
    //     ":Date"    => $date,
    //     ":Time"     => $time,
    //     ":Guests"     => $guests,
    // ]);

    // UPDATE Reservation, Customer
    // SET Reservation.Date = '2019-09-11',
    //     Reservation.Time = '18',
    //     Reservation.Guests = '3',
    //     Customer.Name = 'Cristina',
    //     Customer.Email = 'jakob@edeus.se',
    //     Customer.Phone = '+46708674467'
    // WHERE
    //     Reservation.ReservationID = 145 AND Customer.CustomerID = 17


    $statement = $pdo->prepare(
        "UPDATE Reservation, Customer
        SET Reservation.Date = '$date',
            Reservation.Time = $time,
            Reservation.Guests = $guests,
            Customer.Name = '$name',
            Customer.Email = '$email',
            Customer.Phone = '$phone'
        WHERE
            Reservation.ReservationID = $reservationID AND Customer.CustomerID = $CustomerID
"
    );

    $statement->execute([
        ":Date"    => $date,
        ":Time"     => $time,
        ":Guests"     => $guests,
        ":Name"    => $name,
        ":Email"     => $email,
        ":Phone"     => $phone
    ]);
    
    // $statement = $pdo->prepare(
    //     "UPDATE `Customer` 
    //     SET `Name`= '$name', `Email`= '$email', `Phone`= '$phone'
    //     WHERE `ReservationID`= $reservationID"
    // );

    // $statement->execute([
    //     ":Name"    => $name,
    //     ":Email"     => $email,
    //     ":Phone"     => $phone,
    // ]);

    echo("success");
?>