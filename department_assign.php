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
        

            <div style="overflow-y: scroll; height:400px;">

                                          <table class="table table-bordered" id="member_table">
                  <tr>
                  
                  <th>Department Name</th>
                  <th>Assign Resource</th>
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
                   
                     <td><?php echo $name;?></td>
                     <td>
                       <form method="get" action="department_assign_edit">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                          <input type="hidden" name="name" value="<?php echo $name; ?>">
                          <input type="submit" value="Assign Resource" class="btn btn-info">
                      </form>
                      </td>
                      
                     </tr>
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
