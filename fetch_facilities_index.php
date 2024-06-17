<?php
    include 'config/server.php';
   

 if (isset($_POST['select'])) {

 	$facility_name=$_POST['facility_name'];


      $sql_facid= "SELECT * FROM county_facilities WHERE name='$facility_name'";
              $result_facid=mysqli_query($db,$sql_facid);

              if (mysqli_num_rows($result_facid)!=0) {
                  
                  while ($row_facid=mysqli_fetch_assoc($result_facid)) {
                      
                      $facility_type_id=$row_facid['id'];
                  }
              }

    if($facility_type_id != '' ){  

		$result = $db->query("SELECT * FROM locations WHERE facility_type_id='$facility_type_id'"); 
		 
		$result2 = $db->query("SELECT * FROM locations WHERE facility_type_id='$facility_type_id'");

		$sql_all= "SELECT count(1) FROM locations WHERE facility_type_id='$facility_type_id'";
		$result_all = mysqli_query($db, $sql_all);

		while($row_all= mysqli_fetch_array($result_all)){

		  $count_all=$row_all[0];
		}

	}

}else{

		$result = $db->query("SELECT * FROM locations"); 
 
$result2 = $db->query("SELECT * FROM locations"); 

$sql_all= "SELECT count(1) FROM locations";
$result_all = mysqli_query($db, $sql_all);

while($row_all= mysqli_fetch_array($result_all)){

  $count_all=$row_all[0];
}



}


?>