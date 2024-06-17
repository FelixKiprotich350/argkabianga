<?php

    require 'init.php';

    $username=$_POST['username'];
    $password=$_POST['password']; 

    $password = md5($password);

    $sql="SELECT * FROM users WHERE username='$username'";

    $result=mysqli_query($db,$sql);
    $response=array();

    if(mysqli_num_rows($result)>0){
        $code="failed";
        
        array_push($response,array("code"=>$code));
        echo json_encode($response);
    }else{
        
    $sql_insert="INSERT INTO users (username,password) VALUES ('$username','$password')";
    mysqli_query($db,$sql_insert);

    $code="success";
        
        array_push($response,array("code"=>$code));
        
        echo json_encode($response);
    }
    mysqli_close($db);
