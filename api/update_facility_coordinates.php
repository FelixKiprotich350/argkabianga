<?php

    require 'init.php';

    $facility_id=$_POST['facility_id'];
    $latitude=$_POST['latitude'];
    $longitude=$_POST['longitude'];

    $sql="SELECT * FROM locations WHERE id='$facility_id'";

    $result=mysqli_query($db,$sql);
    $response=array();

    if(mysqli_num_rows($result)>0){
        $code="update_coordinates";

        $sql_update="UPDATE locations SET latitude='$latitude',longitude='$longitude' WHERE id='$facility_id'";
    mysqli_query($db,$sql_update);
        array_push($response,array("code"=>$code));
        echo json_encode($response);
    }
    mysqli_close($db);
