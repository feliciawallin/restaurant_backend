<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type:application/json");
header("Access-Control-Allow-Methods: *");

    include('../dbconnection.php');

    $inputJSON = file_get_contents('php://input');
    $input = json_decode($inputJSON);

    // echo($input);

    $date = $input->bookingDate;
    $guests = $input->bookingGuests;
    $time = $input->bookingTime;
    $name = $input->bookingName;
    $email = $input->bookingEmail;
    $phone = $input->bookingPhone;

    // if (isset($email)) {
        // echo("hej");
        
        $statement = $pdo->prepare(
            "SELECT `CustomerID` FROM `Customer` WHERE `Email` = '$email'"
        );

        $statement->execute();
        $customer = $statement->fetch(PDO::FETCH_OBJ);
        $customerId = $customer->CustomerID;

        if($customerId > 0) {
            $statement = $pdo->prepare(
                "INSERT INTO Reservation (Date, Guests, Time, CustomerID) 
                VALUES (:date, :guests, :time, :customerid)"
            );

            $statement->execute([
                ":date"    => $date,
                ":guests" => $guests,
                ":time" => $time,
                ":customerid" => $customerId
            ]);

        } else {
            $statement = $pdo->prepare(
                "INSERT INTO Customer (Name, Phone, Email) VALUES (:name, :phone, :email)");

            $statement->execute([
                ":name"    => $name,
                ":phone" => $phone,
                ":email" => $email
            ]);

            $lastCustomerID = $pdo->lastInsertId();
    
            $statement = $pdo->prepare(
                "SELECT `CustomerID` FROM `Customer` WHERE `CustomerID` = '$lastCustomerID'"
            );

            $statement->execute();
            $newCustomer = $statement->fetch(PDO::FETCH_OBJ);

            $statement = $pdo->prepare(
                "INSERT INTO Reservation (Date, Time, CustomerID, Guests) VALUES (:date, :time, :customerid, :guests)");

            $statement->execute([
                ":date"    => $date,
                ":time" => $time,
                ":guests" => $guests,
                ":customerid" => $lastCustomerID
            ]);
        }
    // }

    $header .= 'From: nonameresturant@info.se';

    $msg = "
        Thank you for your reservation $name \n 
        Details
        Date: $date,
        Time: $time,
        Number of guests: $guests
    ";
    // use wordwrap() if lines are longer than 70 characters
    $msg = wordwrap($msg,70);
    // send email
    mail($email,$name,$msg, $header);
    
    
?>