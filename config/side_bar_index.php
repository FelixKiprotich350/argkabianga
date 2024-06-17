<nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="index"><i class="menu-icon fa fa-list-ul"></i>All</a>

                    </li>

                    <li class="menu-item-has-children">
                      
                        <form method="POST">
                     <div class="form-group">
                      <label>Select Resource</label>
                          <?php
                            $sql_facility= "SELECT * FROM county_facilities";
                            $result_facility= mysqli_query($db, $sql_facility);
                            ?>
                            <select name="facility_name" class="form-control" id="facility_name">
                              <option></option>

                          <?php while($row_facility = mysqli_fetch_array($result_facility)):;?>

                        <option <?php echo (isset($_POST['facility_name']) && $_POST['facility_name'] == $row_facility['name']) ? 'selected="selected"' : ''; ?>><?php echo $row_facility['name'];?></option>

                          <?php endwhile;?>

                            </select>
                            <?php

                          
                            ?>
                        </div>
                    </li>
                    
                

              <li class="menu-item-has-children">
                <input type="submit" name="select" class="btn btn-info" value="Select">
                </form>
              </li>
              <li class="menu-item-has-children">
                <hr>
                <?php
                include 'fetch_facilities.php';
                ?>
                  
                          <label>Mapped Resources : <?php echo $count_all ; ?></label>
                    
                    
                  </li>  
                </ul>
            </div>
        </nav>

       