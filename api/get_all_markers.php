<?php
    require 'init.php';
    //Checking if any error occured while connecting
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        die();
    }
    
    //creating a query
    $stmt = $db->prepare("SELECT latitude,longitude,facility_name,balance FROM locations");
    
    //executing the query 
    $stmt->execute();
    
    //binding results to the query 
    $stmt->bind_result($latitude,$longitude,$facility_name,$balance);
    
    $response = array(); 
    
    //traversing through all the result 
    while($stmt->fetch()){
        $temp = array();
        
        $temp['latitude'] = $latitude;
        $temp['longitude'] = $longitude;
        $temp['facility_name'] = $facility_name;
        $temp['balance'] = $balance;

        array_push($response, $temp);
    }
    
    //displaying the result in json format 
    echo json_encode($response);