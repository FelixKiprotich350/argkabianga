<?php
	require 'init.php';
	//Checking if any error occured while connecting
	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		die();
	}
	
	//creating a query
	$stmt = $db->prepare("SELECT id,facility_name,facility_type,sub_county,ward FROM locations");
	
	//executing the query 
	$stmt->execute();
	
	//binding results to the query 
	$stmt->bind_result($id,$facility_name,$facility_type,$sub_county,$ward);
	
	$response = array(); 
	
	//traversing through all the result 
	while($stmt->fetch()){
		$temp = array();
		$temp['id'] = $id;
		$temp['facility_name'] = $facility_name;
		$temp['facility_type'] = $facility_type;
		$temp['sub_county'] = $sub_county;
		$temp['ward'] = $ward;

		array_push($response, $temp);
	}
	
	//displaying the result in json format 
	echo json_encode($response);