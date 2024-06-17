<?php
        
        require 'init.php';

if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
        }       
        $sub_county=$_POST['sub_county'];

       // $db->query("SET NAMES 'utf8'");

        $sql="SELECT ward_name FROM ward WHERE subcounty_id='$sub_county'";
        $result=$db->query($sql);
        while($e=mysqli_fetch_assoc($result)){
        $output[]=$e; 
        }
        $show=array("result_ward"=>$output);
        print(json_encode($show)); 
        $db->close();

?>  