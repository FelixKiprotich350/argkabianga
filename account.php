<?php
 session_start();
    include 'config/server.php';

    if(isset($_SESSION["user_id"])){
     $_SESSION['user_id'];
     $user_id=$_SESSION['user_id'];
    }
    if(isset($_SESSION["department_id"])){
     $_SESSION['department_id'];
     $department_id=$_SESSION['department_id'];
    }

    global $message;

   
 if(isset($_POST['update_acc'])){
              $editid = $_POST['editid'];
              $editusername = $_POST['editusername'];
              
  $sql = "UPDATE users SET username='$editusername' WHERE id='$editid' ";
              mysqli_query($db,$sql);

              $message = "Updated";
          }



          if(isset($_POST['update_password'])){
              $editid = $_POST['editid'];
              $old_password = $_POST['old_password'];
              $new_password = $_POST['new_password'];
              $confirm_new_password = $_POST['confirm_new_password'];

              $sql1= "SELECT * FROM users WHERE id='$editid'";
        $result1=mysqli_query($db,$sql1);

        if (mysqli_num_rows($result1)!=0) {
                  
                  while ($row1=mysqli_fetch_assoc($result1)) {
                      
                      $password=$row1['password'];

                      //$password=md5($password);

                      $old_password=md5($old_password);

                      if($password==$old_password)
                      {  
                         if($new_password==$confirm_new_password)
                         {
                          $new_password=md5($new_password);
                          $sql = "UPDATE users SET password='$new_password' WHERE id='$editid' ";
              mysqli_query($db,$sql);
              $message = "Password Changed Successfully";
          }else if ($new_password != $confirm_new_password) {
       $message = "New passwords do not match";
    }
                       


 
          }else if ($password != $old_password) {
       $message = "Old passwords do not match";
    }

          
              
            }
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
    height: 500px;
}
</style>

</head>

<body>
    <!-- Left Panel -->
    <aside id="left-panel" class="left-panel">
        <?php
        
        include 'config/sidebar_settings_profile.php';
        ?>
        
    </aside>
    <!-- /#left-panel -->
    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
        <?php
        include 'config/header.php';
        ?>
    </header>
        <!-- /#header -->
        <!-- Content -->
        <div class="content">

        <div id="mapCanvas">

          <label style="color: blue;"><?php echo $message; ?></label>
        

            <div style="overflow-y: scroll; height:400px;">

                <table class="table table-bordered" id="member_table">
                  <tr>
                  <!--<th>ID</th>-->
                  <th>Username</th>
                  <th>Change Password</th>
                  </tr>
                  <?php 
                   $sql= "SELECT * FROM admin_user WHERE id='$user_id' AND department_id='$department_id'";
              $result=mysqli_query($db,$sql);

              if (mysqli_num_rows($result)!=0) {
                  
                  while ($row=mysqli_fetch_assoc($result)) {
                      
                      $id=$row['id'];
                      $username=$row['username'];
                      ?>
                  <tr>
                     <td><?php echo $username;?></td>
                     <!--<td>
                      <a href="#edit<?php// echo $id;?>" data-toggle="modal"><input class="btn btn-info" type="submit" name="edit" value="Edit"></a>
                      </td>-->
                      <!--<td>
                        <a href="#delete<?php //echo $id;?>" data-toggle="modal"><input class="btn btn-danger" type="submit" name="delete" value="Delete"></a>
                      </td>-->
                      <td>
                        <a href="#change_password<?php echo $id;?>" data-toggle="modal"><input class="btn btn-success" type="submit" name="change_password" value="Change Password"></a>
                      </td>
                     </tr>
                     


 <!-- Edit Class -->
        <div id="edit<?php echo $id; ?>" class="modal fade" role="dialog">
            <form method="POSt">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header" style="background: #398AD7; color: #fff;">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Edit Details</h4>
                        </div>
                        <div class="modal-body">
                    <input type="hidden" name="editid" class="form-control" value="<?php echo $id; ?>">
                    
                    <label>Update Username</label><input type="text" name="editusername" class="form-control" value="<?php echo $username; ?>">
                <br>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" name="update_acc">Update  </button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
              </form>
        </div>        
<!--End of Edit Class-->

 <!-- Edit Class -->
        <div id="change_password<?php echo $id; ?>" class="modal fade" role="dialog">
            <form method="POSt">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header" style="background: #398AD7; color: #fff;">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Change Password</h4>
                        </div>
                        <div class="modal-body">
                    <input type="hidden" name="editid" class="form-control" value="<?php echo $id; ?>"><br>
            <label>Enter Old Password</label><input type="password" name="old_password" class="form-control">
                <br>

                <label>Enter New Password</label><input type="password" name="new_password" class="form-control">
                <br>
                <label>Confirm New Password</label><input type="password" name="confirm_new_password" class="form-control">
                <br>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" name="update_password">Update </button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
              </form>
        </div>        
<!--End of Edit Class-->

<!--Delete Class -->
        <div id="delete<?php echo $id; ?>" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <form method="POSt">
                    <!-- Modal content-->
                    <div class="modal-content">

                        <div class="modal-header" style="background: #398AD7; color: #fff;">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Delete</h4>
                        </div>

                        <div class="modal-body">
                            <input type="hidden" name="deleteid" value="<?php echo $id; ?>">
                            <p>
                                <div class="alert alert-danger">Are you Sure you want Delete <strong><?php echo $username; ?>?</strong></p>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="delete_acc" class="btn btn-danger">YES</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">NO</button>
                            </div>
                        </div>
                </form>
                </div>
            </div>

                   <?php
            }
          }
              ?>

                 </table>
                <!--End of table--> 
              </div>

        </div>
           
        </div>
        

    <?php
    include 'config/scripts.php';
    ?>
</body>

</html>
