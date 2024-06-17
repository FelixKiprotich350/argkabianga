<?php

    require 'init.php';

    $image=$_POST['image'];
    $facility_name=$_POST['facility_name'];
    $facility_type=$_POST['facility_type'];
    $sub_county=$_POST['sub_county'];
    $ward=$_POST['ward'];
    $status=$_POST['status'];
    $physical_location=$_POST['physical_location'];
    $road_street=$_POST['road_street'];
    $description=$_POST['description'];
    $remarks=$_POST['remarks'];
    $latitude=$_POST['latitude'];
    $longitude=$_POST['longitude'];
    
    
    
    $sql= "SELECT * FROM county_facilities WHERE name='$facility_type'";
              $result=mysqli_query($db,$sql);

              if (mysqli_num_rows($result)!=0) {
                  
                  while ($row=mysqli_fetch_assoc($result)) {
                      
                      $facility_type_id=$row['id'];
                      $department_id=$row['department_id'];
                  }
              }
    
    $image_name = uniqid();
    
    $balance=0;

    $upload_path="../profile/$image_name.jpg";

    if($upload_path){

        file_put_contents($upload_path,base64_decode($image));

        $sql_details="INSERT INTO locations (facility_name,facility_type,sub_county,ward,physical_location,road_street,description,remarks,latitude,longitude,balance,image_name,facility_type_id,department_id) VALUES ('$facility_name','$facility_type','$sub_county','$ward','$physical_location','$road_street','$description','$remarks','$latitude','$longitude','$balance','$image_name','$facility_type_id','$department_id')";
    mysqli_query($db,$sql_details);

        echo json_encode(array('response'=>'Image Uploaded Successfully'));
    }else{

        echo json_encode(array('response'=>'Image Upload failed'));
    }
    
    
    mysqli_close($db);
