<?php
 session_start();
    include 'config/server.php';

    global $msg;

    if (isset($_POST['login'])) {

      //$department_name=$_POST['department_name'];
        $username=$_POST['username'];
        $password=$_POST['password'];   
         $enc_password=md5($password);

         /*$sql_dep= "SELECT * FROM county_departments WHERE name='$department_name'";  
       $result_dep=mysqli_query($db,$sql_dep);

        if (mysqli_num_rows($result_dep)!=0) {
                  
                  while ($row_dep=mysqli_fetch_assoc($result_dep)) {

                    $department_id=$row_dep['id'];
                  }
                }*/

      $sql= "SELECT * FROM admin_user WHERE username='$username' and password='$enc_password'";  
       $result=mysqli_query($db,$sql);

        if (mysqli_num_rows($result)!=0) {
                  
                  while ($row=mysqli_fetch_assoc($result)) {

                    $user_id=$row['id'];
                    $department_id=$row['department_id'];
                   $_SESSION['user_id']=$user_id;
                   $_SESSION['department_id']=$department_id;
               
            header("location: dashboard");    
                
             
  }
}if (mysqli_num_rows($result)==0) {
    $msg="Enter Corect Credentials!";
}
}

?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <?php
    include 'config/head.php';
    ?>
<style type="text/css">
  #mapCanvas {
    width: 100%;
    height: 300px;
}
</style>

</head>

<body>
    
        <!-- /#header -->
        <!-- Content -->
        <div class="content">

        <div id="mapCanvas" style="margin-top: 30px;">
        <center>
            <div class="col-md-4">

              
              <br>
              <img src="images/logo2.png"><br>
              <label style="font-weight: 900;">GIS REPORTING PORTAL</label>
            
            <form method="POST">

               
              
              <input type="text" name="username" class="form-control" placeholder="Username" required><br>
              <label></label>
              <input type="password" name="password" class="form-control" placeholder="Password" required><br>
              <input type="submit" name="login" class="btn btn-info" value="Log In">
            </form>

            <label style="color: red;"><?php echo $msg; ?></label>

          </div>

          </center>
        </div>
           
        </div>
        <!-- /.content -->
        <div class="clearfix"></div>
        <!-- Footer -->
        <center>
        <footer class="site-footer">
            
            <div class="footer-inner bg-white">
                <div class="row">
                    <div class="col-sm-12" style="margin-top: 30px;">
                        Copyright &copy; <?php echo date("Y"); ?> - County Government - All Rights Reserved
                    </div>
                    
                </div>
            </div>
            
        </footer>
        </center>
        <!-- /.site-footer -->
    </div>
    <!-- /#right-panel -->

    <?php
    include 'config/scripts.php';
    ?>
</body>
</html>
