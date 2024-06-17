<?php
 session_start();
    include 'config/server.php';
    if(isset($_SESSION["user_id"])!=''){
     $_SESSION['user_id'];
     $user_id=$_SESSION['user_id'];
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
        if(isset($_POST['delete_acc'])){
              $deleteid = $_POST['deleteid'];
              
              $sql = "DELETE FROM county_departments WHERE id='$deleteid' ";
              mysqli_query($db,$sql);
              $message="Deleted";
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
        include 'config/sidebar_settings.php';
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
            

            <input type="submit" name="accommodation" class="btn btn-info" value="Add New" data-toggle="modal" data-target="#accommodation">
            <br>
            <label style="color: blue;"><?php echo $message; ?></label>

            <div style="overflow-y: scroll; height:400px;">

                                          <table class="table table-bordered" id="member_table">
                  <tr>
                  
                  <th>Department Name</th>
                  <th>Edit</th>
                  <th>Delete</th>
                  </tr>
                  <?php 
                   $sql= "SELECT * FROM county_departments ORDER BY id DESC";
              $result=mysqli_query($db,$sql);

              if (mysqli_num_rows($result)!=0) {
                  
                  while ($row=mysqli_fetch_assoc($result)) {
                      
                      $id=$row['id'];
                      $name =$row['name'];
                      ?>
                  <tr>               
                     <!--<td><?php// echo $id;?></td>-->
                   
                     <td><?php echo $name;?></td>
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
                    
                <label>Update Name</label><input type="text" name="name" class="form-control" value="<?php echo $name; ?>" required>
                  
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
                                <div class="alert alert-danger">Are you Sure you want Delete <strong><?php echo $name; ?>?</strong></p>
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