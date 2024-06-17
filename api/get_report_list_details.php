<?php
	require 'init.php';
	//Checking if any error occured while connecting
	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		die();
	}
	
	$message_id=$_POST['message_id'];


$sql= "SELECT * FROM sent_information WHERE id='$message_id'";  
       $result=mysqli_query($db,$sql);

         $response=array();

        if (mysqli_num_rows($result)>0) {

        	$row=mysqli_fetch_row($result);
            $id=$row[0];
        	$description=$row[2];
            $latitude=$row[3];
            $longitude=$row[4];
            $image_name=$row[5];
            $date_sent=$row[6];
            
            $my_image="https://www.countygisreport.rolinsoft.com/images/".$image_name.".jpg";

        	$code_success="success";
        	array_push($response,array("code_success"=>$code_success,"description"=>$description,"latitude"=>$latitude,"longitude"=>$longitude,
        	"image_name"=>$image_name,"date_sent"=>$date_sent,"image"=>$my_image));
        	echo json_encode($response);

        	}else{

        		$code_success="failed";
        		$message="Not found please try again";
        	array_push($response,array("code_success"=>$code_success,"message"=>$message));
        	echo json_encode($response);

        	}
        	mysqli_close($db);
	?>