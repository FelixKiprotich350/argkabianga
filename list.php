<?php
 session_start();
    include 'config/server.php';
    if(isset($_SESSION["user_id"])!=''){
     $_SESSION['user_id'];
     $user_id=$_SESSION['user_id'];
    }

    $get_facility_name = $_GET['facility_name'];

    $sql_fac_id= "SELECT * FROM county_facilities WHERE name='$get_facility_name'";
              $result_fac_id=mysqli_query($db,$sql_fac_id);

              if (mysqli_num_rows($result_fac_id)!=0) {
                  
                  while ($row_fac_id=mysqli_fetch_assoc($result_fac_id)) {
                      
                      $fac_id=$row_fac_id['id'];
                    }
                  }

    global $message;

    if (isset($_POST['save'])) {

      
      $username=$_POST['username'];
       $enc_password=md5($username);

        $sql="INSERT INTO users (department_id,username,password) VALUES ('$department_id','$username','$enc_password')";
            mysqli_query($db,$sql);

            $message="Saved";
     
}

 if(isset($_POST['update_acc'])){
              $editid = $_POST['editid'];
              $facility_name=$_POST['facility_name'];
              $physical_location=$_POST['physical_location'];
              $road_street=$_POST['road_street'];
              $description=$_POST['description'];
              $remarks=$_POST['remarks'];

              $password = $_POST['password'];
              $enc_password=md5($password);

              $sql= "SELECT * FROM users WHERE password='$enc_password'";  
       $result=mysqli_query($db,$sql);

        if (mysqli_num_rows($result)!=0) {
                  
                  while ($row=mysqli_fetch_assoc($result)) {  
             
       $sql_update = "UPDATE locations SET facility_name='$facility_name',physical_location='$physical_location',road_street='$road_street',description='$description',remarks='$remarks' WHERE id='$editid' ";
             
              mysqli_query($db,$sql_update);

              $message="Updated";

            }
          }else if (mysqli_num_rows($result)==0) {

            $message="Incorrect Password!";

          }
          

    }

          //Delete teacher    
if(isset($_POST['delete_acc'])){
              $deleteid = $_POST['deleteid'];

              $password = $_POST['password'];
              $enc_password=md5($password);

              $sql= "SELECT * FROM users WHERE password='$enc_password'";  
       $result=mysqli_query($db,$sql);

        if (mysqli_num_rows($result)!=0) {
                  
                  while ($row=mysqli_fetch_assoc($result)) {  
              
              $sql_delete = "DELETE FROM locations WHERE id='$deleteid' ";
              mysqli_query($db,$sql_delete);
              $message="Deleted";
            }
          }else if (mysqli_num_rows($result)==0) {

            $message="Incorrect Password!";

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
    <!--<aside id="left-panel" class="left-panel">
        <?php
        //include 'config/sidebar_settings.php';
        ?>
        
    </aside>-->
    <!-- /#left-panel -->
    <!-- Right Panel -->
    <!--<div id="right-panel" class="right-panel">
        <?php
        //include 'config/header.php';
        ?>
    </header>-->
        <!-- /#header -->
        <!-- Content -->
        <div class="content">



        <div id="mapCanvas">
  <div class="row">
<div class="col-md-3">
        
&emsp;&emsp;&emsp;&emsp;<label style="font-weight: 900;"><?php echo $get_facility_name; ?></label>
</div>
      <div class="col-md-6">
    
    <input type="text" name="search" placeholder="What you looking for?" id="search" class="form-control" /> 
    </div>

  </div>

            <label style="color: blue;"><?php echo $message; ?></label>

            <div style="overflow-y: scroll; height:400px;">

                  <table class="table table-bordered" id="member_table">
                  <tr>
                  
                  <th>Name</th>
                  <th>Type</th>
                  <th>Sub County</th>
                  <th>Ward</th>
                  <th>Physical_Loc</th>
                  <th>Road/Street</th>
                  <th>Description</th>
                  <th>Remarks</th>
                  <th>Latitude</th>
                  <th>Longitude</th>
                  <th>Edit</th>
                  <th>Delete</th>
                  </tr>
                  <?php 
                   $sql= "SELECT * FROM locations WHERE facility_type_id='$fac_id'";
              $result=mysqli_query($db,$sql);

              if (mysqli_num_rows($result)!=0) {
                  
                  while ($row=mysqli_fetch_assoc($result)) {
                      
                      $id=$row['id'];
                      $facility_name =$row['facility_name'];
                      $facility_type =$row['facility_type'];
                      $sub_county =$row['sub_county'];
                      $ward =$row['ward'];
                      $physical_location =$row['physical_location'];
                      $road_street =$row['road_street'];
                      $description =$row['description'];
                      $remarks =$row['remarks'];
                      $latitude =$row['latitude'];
                      $longitude =$row['longitude'];
                      ?>
                  <tr>             
                   
                     <td><?php echo $facility_name;?></td>
                     <td><?php echo $facility_type;?></td>
                     <td><?php echo $sub_county;?></td>
                     <td><?php echo $ward;?></td>
                     <td><?php echo $physical_location;?></td>
                     <td><?php echo $road_street;?></td>
                     <td><?php echo $description;?></td>
                     <td><?php echo $remarks;?></td>
                     <td><?php echo $latitude;?></td>
                     <td><?php echo $longitude;?></td>
                     <td>
                      <a href="#edit<?php echo $id;?>" data-toggle="modal"><input class="btn btn-info" type="submit" name="edit" value="Edit"></a>
                      </td>
                      <td>
                        <a href="#delete<?php echo $id;?>" data-toggle="modal"><input class="btn btn-danger" type="submit" name="delete" value="Delete"></a>
                      </td>
                     </tr>


 <!-- Edit Class -->
        <div id="edit<?php echo $id; ?>" class="modal fade" role="dialog">
            <form method="POST">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header" style="background: #398AD7; color: #fff;">
                          
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            
                        </div>
                        <div class="modal-body">
                    <input type="hidden" name="editid" class="form-control" value="<?php echo $id; ?>">
                    
                <label>Update Name</label><input type="text" name="facility_name" class="form-control" value="<?php echo $facility_name; ?>" required>
                <label>Update Physical Location</label><input type="text" name="physical_location" class="form-control" value="<?php echo $physical_location; ?>" required>
                <label>Update Road/Street</label><input type="text" name="road_street" class="form-control" value="<?php echo $road_street; ?>" required>
                <label>Update Description</label>
                <textarea name="description" rows="3" class="form-control">
                  <?php echo $description; ?>
                </textarea>

                <label>Update Remarks</label>
                <textarea name="remarks" rows="3" class="form-control">
                  <?php echo $remarks; ?>
                </textarea>
                <br>
                <input type="password" name="password" placeholder="Enter your Password" required>
                  
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
                                <div class="alert alert-danger">Are you Sure you want Delete <strong><?php echo $facility_name; ?>?</strong></p>
                                  <input type="password" name="password" placeholder="Enter your Password" required>
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
        <div class="row">
        <div class="col-md-3">
           <input type="button" class="btn btn-success" onclick="location.href='dashboard';" value="Go Back" />
         </div>
         <div class="col-md-3">
           <?php
           $sql_all= "SELECT count(1) FROM locations WHERE facility_type_id='$fac_id'";
            $result_all = mysqli_query($db, $sql_all);

            while($row_all= mysqli_fetch_array($result_all)){

              $count_all=$row_all[0];
              ?>
            <label style="font-weight: 900;">Mapped <?php echo $get_facility_name; ?> : <?php echo $count_all ; ?></label>
              <?php
            }
           ?>
         </div>
        </div>


        <!--Add New-->
    <div class="modal fade" id="accommodation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form method="POST">

      <div class="modal-body">
        <div class="form-group">
          <hr>
          
           <label>Username</label><input type="text" name="username" class="form-control" required>
         
         
        </div>
      </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" name="save" class="btn btn-primary">Save</button>
      </div>

    </form>
  </div>
    </div>
  </div>
  <!--End Add New-->
        

    <?php
    include 'config/scripts.php';
    ?>
</body>

<script>  
      $(document).ready(function(){  
           $('#search').keyup(function(){  
                search_table($(this).val());  
           });  
           function search_table(value){  
                $('#member_table tr').each(function(){  
                     var found = 'false';  
                     $(this).each(function(){  
                          if($(this).text().toLowerCase().indexOf(value.toLowerCase()) >= 0)  
                          {  
                               found = 'true';  
                          }  
                     });  
                     if(found == 'true')  
                     {  
                          $(this).show();  
                     }  
                     else  
                     {  
                          $(this).hide();  
                     }  
                });  
           }  
      });  
 </script> 

</html>
