<?php
header("Content-Type:application/json");
if (isset($_GET['Name']) && $_GET['Name']!="") {
    include('db.php');
    $customer_name = $_GET['Name'];

    $statement = $pdo->prepare("SELECT * FROM `Customer` WHERE Name=$customer_name");
    //Execute it
    $statement->execute();
    //And fetch every row that it returns. $products is now an Associative array
    $customer = $statement->fetchAll(PDO::FETCH_ASSOC);
}else{
    response(NULL, NULL, 400,"Invalid Request");
    }
    
    function response($customer_name){
        $response['Name'] = $customer_name;
        
        $json_response = json_encode($response);
        echo $json_response;
       }  
?>