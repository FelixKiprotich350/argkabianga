<?php
	require 'init.php';
	//Checking if any error occured while connecting
	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		die();
	}
	

	$latitude=$_POST['latitude'];


$sql= "SELECT * FROM locations WHERE latitude='$latitude'";  
       $result=mysqli_query($db,$sql);

         $response=array();

        if (mysqli_num_rows($result)>0) {

        	$row=mysqli_fetch_row($result);
            
            $facility_name=$row[1];
            $facility_type=$row[2];
            $sub_county=$row[3];
            $ward=$row[4];
            $physical_location=$row[5];
            $road_street=$row[6];

        	$code_success="success";
        	array_push($response,array("code_success"=>$code_success,"facility_name"=>$facility_name,"facility_type"=>$facility_type,"sub_county"=>$sub_county,"ward"=>$ward,"physical_location"=>$physical_location,"road_street"=>$road_street));

        	echo json_encode($response);

        	}else{

        		$code_success="failed";
        		$message="Not found please try again";
        	array_push($response,array("code_success"=>$code_success,"message"=>$message));
        	echo json_encode($response);

        	}
        	mysqli_close($db);
	?>