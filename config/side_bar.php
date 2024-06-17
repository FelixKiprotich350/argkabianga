<nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="dashboard"><i class="menu-icon fa fa-laptop"></i>Dashboard </a>

                    </li>

                    <li class="menu-item-has-children">
                        <?php
                        $sql_all= "SELECT count(1) FROM sent_information WHERE status='Pending'";
                        $result_all = mysqli_query($db, $sql_all);

                        while($row_all= mysqli_fetch_array($result_all)){

                          $count_all=$row_all[0];
                          ?>
                          <a href="report_portal"> <i class="menu-icon fa fa-plus"></i>Received (<?php echo $count_all; ?>)</a>
                          <?php
                        
                        }
                        ?>
                    
                    </li>

                    <li class="menu-item-has-children">
                    <a href="forwarded"> <i class="menu-icon fa fa-plus"></i>Forwarded</a>
                    </li>

                    <li class="menu-item-has-children">
                    <a href="resolved"> <i class="menu-icon fa fa-plus"></i>Resolved</a>
                    </li>

                   
                    
                </ul>
            </div>
        </nav>

       