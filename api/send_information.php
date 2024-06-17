<?php

    require 'init.php';
    
    $current_date=date("Y/m/d");

    $image=$_POST['image'];
    $description=$_POST['description'];
    $latitude=$_POST['latitude'];
    $longitude=$_POST['longitude'];
    $user_id=$_POST['user_id'];
    
    
    
    /*$sql= "SELECT * FROM sent_information WHERE description='$description'";
              $result=mysqli_query($db,$sql);

              if (mysqli_num_rows($result)!=0) {
                  
                  while ($row=mysqli_fetch_assoc($result)) {
                      
                      $facility_type_id=$row['id'];
                      $department_id=$row['department_id'];
                  }
              }*/
    
    $image_name = uniqid();
    
    $balance=0;

    $upload_path="../images/$image_name.jpg";

    if($upload_path){

        file_put_contents($upload_path,base64_decode($image));

        $sql_details="INSERT INTO sent_information (user_id,description,latitude,longitude,image_name,date_sent,status) VALUES ('$user_id','$description','$latitude','$longitude','$image_name','$current_date','Pending')";
    mysqli_query($db,$sql_details);

        echo json_encode(array('response'=>'Information Sent Successfully'));
    }else{

        echo json_encode(array('response'=>'Information NOT Sent'));
    }
    
    
    mysqli_close($db);
