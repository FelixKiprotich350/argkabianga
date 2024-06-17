<?php
	require 'init.php';
	//Checking if any error occured while connecting
	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		die();
	}
	
	$id=$_POST['id'];


$sql= "SELECT * FROM locations WHERE id='$id'";  
       $result=mysqli_query($db,$sql);

         $response=array();

        if (mysqli_num_rows($result)>0) {

        	$row=mysqli_fetch_row($result);
            $id=$row[0];
        	$facility_name=$row[1];
            $facility_type=$row[2];
            $sub_county=$row[3];
            $ward=$row[4];
            $physical_location=$row[5];
            $road_street=$row[6];
            $description=$row[7];
            $remarks=$row[8];
            $latitude=$row[9];
            $longitude=$row[10];

        	$code_success="success";
        	array_push($response,array("code_success"=>$code_success,"facility_name"=>$facility_name,"facility_type"=>$facility_type,"sub_county"=>$sub_county,
        	"ward"=>$ward,"physical_location"=>$physical_location,"road_street"=>$road_street,"description"=>$description,"remarks"=>$remarks,
        	"latitude"=>$latitude,"longitude"=>$longitude));
        	echo json_encode($response);

        	}else{

        		$code_success="failed";
        		$message="Not found please try again";
        	array_push($response,array("code_success"=>$code_success,"message"=>$message));
        	echo json_encode($response);

        	}
        	mysqli_close($db);
	?>