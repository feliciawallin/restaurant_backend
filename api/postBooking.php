<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type:application/json");

    include('../dbconnection.php');

    $inputJSON = file_get_contents('php://input');
    $input = json_decode($inputJSON);
 

    $date = $input->bookingDate;
    $guests = $input->bookingGuests;
    $time = $input->bookingTime;

    $name = $input->bookingName;
    $email = $input->bookingEmail;
    $phone = $input->bookingPhone;
    // $bookingId = $input->bookingID;

    //    echo("starts");
    // echo($input);

    if (isset($email)) {

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

            $lastCustomerID = $newCustomer->latestInsertId();
            $statement = $pdo->prepare(
                "SELECT `CustomerID` FROM `Customer` WHERE `CustomerID` = '$lastCustomerID'"
            );

            $statement->execute();
            $newCustomer = $statement->fetch(PDO::FETCH_OBJ);

            $statement = $pdo->prepare(
                "INSERT INTO Reservation (Date, Time, CustomerID, Guests) VALUES (:date, :time, :customerID, :guests)");

            $statement->execute([
                ":date"    => $date,
                ":time" => $time,
                ":guests" => $guests,
                "customerID" => $newCustomer
            ]);
        }
    }


    $msg = "First line of text\nSecond line of text";
    // use wordwrap() if lines are longer than 70 characters
    $msg = wordwrap($msg,70);
    // send email
    mail("jakob@edeus.se","My subject",$msg);
    
    
?>