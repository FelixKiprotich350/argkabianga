<?php
    require 'init.php';
    //Checking if any error occured while connecting
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        die();
    }
    
    $facility_name=$_POST['facility_name'];
    
    $sql= "SELECT * FROM county_facilities WHERE name='$facility_name'";
              $result=mysqli_query($db,$sql);

              if (mysqli_num_rows($result)!=0) {
                  
                  while ($row=mysqli_fetch_assoc($result)) {
                      
                      $facility_type_id=$row['id'];
                  }
              }
    
    //creating a query
    $stmt = $db->prepare("SELECT latitude,longitude,facility_name,balance FROM locations WHERE facility_type_id='$facility_type_id'");
    
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