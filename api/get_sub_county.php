<?php
        
        require 'init.php';

if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
        }       

       // $db->query("SET NAMES 'utf8'");

        $sql="SELECT subcounty_name FROM subcounty";
        $result=$db->query($sql);
        while($e=mysqli_fetch_assoc($result)){
        $output[]=$e; 
        }
        $show=array("result_sub_county"=>$output);
        print(json_encode($show)); 
        $db->close();

?>  