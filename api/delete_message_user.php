<?php

    require 'init.php';

    $message_id=$_POST['message_id'];
    //$s_image=$_POST['s_image'];
    
    /*$sql="SELECT * FROM sent_information WHERE id='$message_id'";

    $result=mysqli_query($db,$sql);
    

    if(mysqli_num_rows($result)!=0){*/
    
    
    
    $sql_term= "SELECT * FROM sent_information WHERE id='$message_id'";
    
    $result_term= mysqli_query($db, $sql_term);
    
 if (mysqli_num_rows($result_term)!=0) {
     
     $response=array();
  
  while ($row_term=mysqli_fetch_assoc($result_term)) {
      
      $image_name=$row_term['image_name'];
    
        
        
        
        $filePath="../images/".$image_name.".jpg";
        //$filePath="../images/$image_name.jpg";
        //$filePath="https://www.countygisreport.rolinsoft.com/images/".$image_name.".jpg";
    
        unlink($filePath);
        
        
    $sql_delete="DELETE FROM sent_information WHERE id='$message_id'";
    mysqli_query($db,$sql_delete);
    
    $code="success";
    
        array_push($response,array("code"=>$code));
        
        echo json_encode($response);
       
    }
 }

