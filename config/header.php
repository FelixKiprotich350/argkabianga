
<!-- Header-->
        <header id="header" class="header">
            <div class="top-left">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#"><img src="images/home_dsh.jpg" alt="Logo"></a>
                    <a class="navbar-brand hidden" href="#"><img src="images/logo2.png" alt="Logo"></a>
                    <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
                </div>


            </div>
            
            <div class="top-right">

                


                <div class="header-menu">

                    <label style="margin-top: 0.4%; margin-right: 40%; font-weight: 900; font-size: 24px;">GIS REPORTING PORTAL</label>

                    <div class="user-area dropdown float-right">

                        <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php
                        $sql= "SELECT * FROM admin_user WHERE id='$user_id'";
                        $result=mysqli_query($db,$sql);

                        if (mysqli_num_rows($result)!=0) {
                            
                            while ($row=mysqli_fetch_assoc($result)) {
                                
                                $username=$row['username'];
                                ?>
                              <img class="user-avatar rounded-circle" src="images/admin.png" alt="User Avatar">
                                <label style="font-weight: 900;"><?php echo $username; ?></label>
                            
                        
                                <?php
                              }
                            }
                        ?>

                        </a>

                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="account"><i class="fa fa- user"></i>My Profile</a>

                            <a class="nav-link" href="department"><i class="fa fa -cog"></i>Settings</a>
                            

                            <a class="nav-link" href="logout"><i class="fa fa-power -off"></i>Logout</a>
                        </div>
                    </div>

                </div>
            </div>
        </header>

        <div class="modal fade" id="export_data" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form method="POST" action="export_to_excel">

      <div class="modal-body">
        <div class="form-group">
          <hr>
          
           
         <div class="form-group">
      <?php
      
        $sql_facilities= "SELECT * FROM county_facilities";
        $result_facilities = mysqli_query($db, $sql_facilities);
        ?>
        <select name="facility_name" class="form-control" required>
          <option></option>
      <?php while($row_facilities = mysqli_fetch_array($result_facilities)):;?>

      <option><?php echo $row_facilities['name'];?></option>

      <?php endwhile;?>

        </select>
              <?php
            
        ?>
    </div>
         
        </div>
      </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" name="btn_export" class="btn btn-primary">Export To Excel</button>
      </div>

    </form>
  </div>
    </div>
  </div>

    <div class="modal fade" id="list" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form method="GET" action="list">

      <div class="modal-body">
        <div class="form-group">
          <hr>
          
           
         <div class="form-group">
      <?php
      if($department_id==1){
        $sql_facilities= "SELECT * FROM county_facilities";
        $result_facilities = mysqli_query($db, $sql_facilities);
        ?>
        <select name="facility_name" class="form-control" required>
          <option></option>
      <?php while($row_facilities = mysqli_fetch_array($result_facilities)):;?>

      <option><?php echo $row_facilities['name'];?></option>

      <?php endwhile;?>

        </select>
              <?php
            }
          else{
            $sql_facilities= "SELECT * FROM county_facilities WHERE department_id='$department_id'";
        $result_facilities = mysqli_query($db, $sql_facilities);
        ?>
        <select name="facility_name" class="form-control" required>
          <option></option>
      <?php while($row_facilities = mysqli_fetch_array($result_facilities)):;?>

      <option><?php echo $row_facilities['name'];?></option>

      <?php endwhile;?>

        </select>
              <?php
          }
        ?>
    </div>
         
        </div>
      </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" name="btn_list" class="btn btn-primary">Open List</button>
      </div>

    </form>
  </div>
    </div>
  </div>