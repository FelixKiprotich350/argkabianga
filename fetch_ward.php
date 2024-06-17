<?php
  session_start();
    include 'config/server.php';
    if(isset($_SESSION["user_id"])!=''){
     $_SESSION['user_id'];
     $user_id=$_SESSION['user_id'];
    }

 $output='';
 	$sc_id=$_POST["subcountyId"];

 $sql="SELECT * FROM ward WHERE subcounty_id='$sc_id'";
 $result=mysqli_query($db,$sql);
    $output .='<option></option>';

    while($row = mysqli_fetch_array($result)){

    	//$output .='<option value="'.$row["ward_name"].'">'.$row["ward_name"].'</option>';

    	$output .='<option>'.$row["ward_name"].'</option>';

    	//$output .='<option '. echo (isset($_POST['sub_county']) && $_POST['sub_county'] == $row_sub_county['subcounty_name']) ? 'selected="selected"' : '';.'>'.$row["ward_name"].'</option>';
    }
    echo $output;
?>