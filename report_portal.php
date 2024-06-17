<?php
session_start();
include 'config/server.php';
if (isset($_SESSION["user_id"]) != '') {
  $_SESSION['user_id'];
  $user_id = $_SESSION['user_id'];
}

if (isset($_SESSION["user_id"]) != '') {
  $_SESSION['user_id'];
  $user_id = $_SESSION['user_id'];
}
if (isset($_SESSION["department_id"])) {
  $_SESSION['department_id'];
  $department_id = $_SESSION['department_id'];
}

$current_date = date("Y/m/d");

global $message;

if (isset($_POST['save'])) {


  $name = $_POST['name'];

  $sql = "INSERT INTO county_departments (name) VALUES ('$name')";
  mysqli_query($db, $sql);

  $message = "Saved";

}

if (isset($_POST['update_acc'])) {
  $editid = $_POST['editid'];
  $name = $_POST['name'];

  $sql = "UPDATE county_departments SET name='$name' WHERE id='$editid' ";

  mysqli_query($db, $sql);

  $message = "Updated";


}

//Delete teacher    
if (isset($_POST['btn_forward'])) {
  $f_id = $_POST['id'];
  $department_id = $_POST['department_id'];

  $sql = "SELECT * FROM sent_information WHERE id='$f_id'";
  $result = mysqli_query($db, $sql);

  if (mysqli_num_rows($result) != 0) {

    while ($row = mysqli_fetch_assoc($result)) {

      $id = $row['id'];
      $user_id = $row['user_id'];
      $description = $row['description'];
      $latitude = $row['latitude'];
      $longitude = $row['longitude'];
      $image_name = $row['image_name'];
      $date_sent = $row['date_sent'];
      $resolved = 0;

      $sql_save = "INSERT INTO forwarded (user_id,description,latitude,longitude,image_name,date_sent,date_forwarded,resolved,department_id) VALUES ('$user_id','$description','$latitude','$longitude','$image_name','$date_sent','$current_date','$resolved','$department_id')";
      mysqli_query($db, $sql_save);

      //$sql_delete = "DELETE FROM sent_information WHERE id='$f_id' ";
      //mysqli_query($db,$sql_delete);
      $sql_update = "UPDATE sent_information SET status='Received' WHERE id='$f_id' ";
      mysqli_query($db, $sql_update);


      $message = "Forwarded";
    }
  }
}
?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang=""> <!--<![endif]-->

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
              <th>Forward</th>

            </tr>
            <?php
            $sql = "SELECT * FROM sent_information ORDER BY id DESC";
            $result = mysqli_query($db, $sql);

            if (mysqli_num_rows($result) != 0) {

              while ($row = mysqli_fetch_assoc($result)) {

                $id = $row['id'];
                $description = $row['description'];
                $image_name = $row['image_name'];
                $date_sent = $row['date_sent'];
                $status = $row['status'];
                ?>
                <tr>
                  <!--<td><? php// echo $id; ?></td>-->

                  <td><?php echo $description; ?></td>
                  <td>
                    <img style="width: 50px;" src="images/<?php echo $image_name . ".jpg"; ?>">

                  </td>
                  <td><?php echo $date_sent; ?></td>

                  <td>
                    <?php

                    if ($status == "Received") {
                      ?>
                      <label style="color: blue;">Forwarded</label>
                      <?php
                    } else {
                      ?>
                      <a href="#forward<?php echo $id; ?>" data-toggle="modal"><input class="btn btn-warning" type="submit"
                          name="forward" value="Forward"></a>
                      <?php
                    }

                    ?>

                  </td>
                  <td>
                    <a href="#edit_view_image<?php echo $id; ?>" data-toggle="modal"><input class="btn btn-warning"
                        type="submit" name="edit_view_image" value="View Image"></a>
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

                          <label>Update Name</label><input type="text" name="name" class="form-control"
                            value="<?php echo $name; ?>" required>

                        </div>
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-primary" name="update_acc">Update </button>
                          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
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
                          <img src="images/<?php echo $image_name . ".jpg"; ?>">

                        </div>
                        <div class="modal-footer">

                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
                <!--End of Edit Class-->

                <!--Delete Class -->
                <div id="forward<?php echo $id; ?>" class="modal fade" role="dialog">
                  <div class="modal-dialog">
                    <form method="POSt">
                      <!-- Modal content-->
                      <div class="modal-content">

                        <div class="modal-header" style="background: #398AD7; color: #fff;">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">Forward</h4>
                        </div>

                        <div class="modal-body">
                          <input type="hidden" name="id" value="<?php echo $id; ?>">
                          <p>
                          <div class="alert alert-warning">Are you Sure you want Forward
                            <strong><?php echo $name; ?>?</strong></p>

                            <div class="form-group">
                              <label>Select Department</label>
                              <?php
                              $sql_dep = "SELECT * FROM county_departments";
                              $result_dep = mysqli_query($db, $sql_dep);
                              ?>
                              <select name="department_id" class="form-control" required>

                                <option></option>

                                <?php while ($row_dep = mysqli_fetch_array($result_dep)):
                                  ; ?>

                                  <option value="<?php echo $row_dep['id']; ?>"><?php echo $row_dep['name']; ?></option>

                                <?php endwhile; ?>

                              </select>
                              <?php

                              ?>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" name="btn_forward" class="btn btn-info">YES</button>
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