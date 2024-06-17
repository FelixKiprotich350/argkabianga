<?php
  session_start();
    include 'config/server.php';
    if(isset($_SESSION["user_id"])!=''){
     $_SESSION['user_id'];
     $user_id=$_SESSION['user_id'];
    }

    if(isset($_SESSION["user_id"])!=''){
     $_SESSION['user_id'];
     $user_id=$_SESSION['user_id'];
    }
    if(isset($_SESSION["department_id"])){
     $_SESSION['department_id'];
     $department_id=$_SESSION['department_id'];
    }

    global $message;

    if (isset($_POST['save'])) {

      
      $name=$_POST['name'];

        $sql="INSERT INTO county_departments (name) VALUES ('$name')";
            mysqli_query($db,$sql);

            $message="Saved";
     
}

 if(isset($_POST['update_acc'])){
              $editid = $_POST['editid'];
              $name=$_POST['name'];
             
       $sql = "UPDATE county_departments SET name='$name' WHERE id='$editid' ";
             
              mysqli_query($db,$sql);

              $message="Updated";
          

          }

          //Delete teacher    
        if(isset($_POST['btn_resolve'])){
              $f_id = $_POST['id'];
              $description = $_POST['description'];
              
              $sql_resolve = "UPDATE forwarded SET details='$description', resolved='1' WHERE id='$f_id' ";
              mysqli_query($db,$sql_resolve);

              $message="Resolved";
            
          
          }

  if(isset($_POST['btn_view_map'])){
    $location_id = $_POST['location_id'];

    $_SESSION['location_id']=$location_id;

    header("location: view_map.php"); 

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

#locMap {
    width: 100%;
    height: 300px;
}
</style>

</head>

<body>
    <!-- Left Panel -->
    <aside id="left-panel" class="left-panel">
        <?php
        include 'config/side_bar.php';
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
                  
                  <th>Description</th>
                  <th>Image</th>
                  <th>Date Sent</th>
                  <th>Date Forwarded</th>
                  <th>Status</th>
                 
                  </tr>
                  <?php 
                   $sql= "SELECT * FROM forwarded ORDER BY id DESC";//WHERE department_id='$department_id'
              $result=mysqli_query($db,$sql);

              if (mysqli_num_rows($result)!=0) {
                  
                  while ($row=mysqli_fetch_assoc($result)) {
                      
                      $id=$row['id'];
                      $description =$row['description'];
                      $image_name =$row['image_name'];
                      $date_sent =$row['date_sent'];
                      $date_forwarded =$row['date_forwarded'];
                      $resolved =$row['resolved'];
                      $latitude =$row['latitude'];
                      $longitude =$row['longitude'];

                      ?>
                  <tr>               
                     <!--<td><?php// echo $id;?></td>-->
                   
                     <td><?php echo $description;?></td>
                     <td>
                      <img style="width: 50px;" src="images/<?php echo $image_name.".jpg"; ?>">
                       
                     </td>
                     <td><?php echo $date_sent;?></td>
                     <td><?php echo $date_forwarded;?></td>
                     <td>
                      <form method="POST">
                        <input type="hidden" name="location_id" value="<?php echo $id; ?>">

                          <button type="submit" name="btn_view_map" class="btn btn-default"><i class="fa fa-map-marker"></i> View Location</button>
                         </form>
                     </td>
                      <td>
                        <?php
                        if($resolved==0){
                          ?>
                          <a href="#pending<?php echo $id;?>" data-toggle="modal"><input class="btn btn-success" type="submit" name="pending" value="Pending"></a>
                          <?php
                        }else if($resolved==1){
                          ?>
                          <label style="font-weight: 900; color: blue;">Resolved</label>
                          <?php
                        }
                        ?>
                        

                      </td>
                      <td>
                        <a href="#edit_view_image<?php echo $id;?>" data-toggle="modal"><input class="btn btn-warning" type="submit" name="edit_view_image" value="View Image"></a>
                      </td>
                     </tr>


 <!-- Edit Class -->
        <div id="pending<?php echo $id; ?>" class="modal fade" role="dialog">
            <form method="POST">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header" style="background: #398AD7; color: #fff;">
                          
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            
                        </div>
                        <div class="modal-body">
                    <input type="hidden" name="id" class="form-control" value="<?php echo $id; ?>">
                    <label style="font-weight: 900; font-size: 26px;">Are you sure you want to mark as resolved?</label>

                    <input type="text" name="description" class="form-control" placeholder="Enter description / details" required>
                  
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" name="btn_resolve">Yes</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                        </div>
                    </div>
                </div>
              </form>
        </div>        
<!--End of Edit Class-->

<!-- Edit Class -->
        <div id="edit_view_image<?php echo $id; ?>" class="modal fade" role="dialog">
            <form method="POST">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header" style="background: #398AD7; color: #fff;">
                          
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            
                        </div>
                        <div class="modal-body">
                    <input type="hidden" name="editid" class="form-control" value="<?php echo $id; ?>">
                    <img src="images/<?php echo $image_name.".jpg"; ?>">
                  
                        </div>
                        <div class="modal-footer">
                            
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
              </form>
        </div>        
<!--End of Edit Class-->


                   <?php
            }
          }
              ?>

                 </table>
                <!--End of table--> 
              </div>

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
          
           <label>Name</label><input type="text" name="name" class="form-control" required>
         
         
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

</html>
