<?php
	require 'init.php';
	//Checking if any error occured while connecting
	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		die();
	}

	$user_id=$_POST['user_id'];
	
	//creating a query
	$stmt = $db->prepare("SELECT id,description,date_sent,status FROM sent_information WHERE user_id='$user_id' ORDER BY id DESC");
	
	//executing the query 
	$stmt->execute();
	
	//binding results to the query 
	$stmt->bind_result($id,$description,$date_sent,$status);
	
	$response = array(); 
	
	//traversing through all the result 
	while($stmt->fetch()){
		$temp = array();
		$temp['id'] = $id;
		$temp['description'] = $description;
		$temp['date_sent'] = $date_sent;
		$temp['status'] = $status;

		array_push($response, $temp);
	}
	
	//displaying the result in json format 
	echo json_encode($response);