<?php
require 'init.php';

$username=$_POST['username'];
$password=$_POST['password'];

$enc_password = md5($password);

$sql= "SELECT * FROM users WHERE username='$username' and password='$enc_password' and roles='0'";  
       $result=mysqli_query($db,$sql);

         $response=array();

        if (mysqli_num_rows($result)>0) {

            $row=mysqli_fetch_row($result);
            $id=$row[0];
            //$name=$row[1];
            //$username=$row[2];
            $code="login_success";
            array_push($response,array("code"=>$code,"id"=>$id));
            echo json_encode($response);

            }else{

                $code="login_failed";
                $message="User not found please try again";
            array_push($response,array("code"=>$code,"message"=>$message));
            echo json_encode($response);

            }
            mysqli_close($db);

?>