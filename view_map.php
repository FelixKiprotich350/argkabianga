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
    if(isset($_SESSION["location_id"])){
     $_SESSION['location_id'];
     $location_id=$_SESSION['location_id'];
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

              $sql_resolve = "UPDATE forwarded SET resolved='1' WHERE id='$f_id' ";
              mysqli_query($db,$sql_resolve);

              $message="Resolved";
            
          
    }
    if(isset($_POST['btn_share_now'])){
    $location_id = $_POST['location_id'];

    $_SESSION['location_id']=$location_id;

    header("location: view_map.php"); 

}

 $sql_map= "SELECT * FROM forwarded WHERE id='$location_id'";
              $result_map=mysqli_query($db,$sql_map);
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
    height: 400px;
}
</style>

<script>
function initMap() {
    var map;
    //var bounds = new google.maps.LatLngBounds();

    var center = new google.maps.LatLng(0.517968,35.273659);

    var mapOptions = {

        center: center,
        mapTypeId: 'roadmap'
        //mapTypeId: 'satellite'

    };
                    
    // Display a map on the web page
    map = new google.maps.Map(document.getElementById("mapCanvas"), mapOptions);
    map.setTilt(100);

     
    // Multiple markers location, latitude, and longitude
    var markers = [
        <?php if($result_map->num_rows > 0){ 
            while($row_map = $result_map->fetch_assoc()){ 
                
                echo '["'.$row_map['name'].'", '.$row_map['latitude'].', '.$row_map['longitude'].', "'.$row_map['icon'].'"],'; 
                
            } 
        }
        ?>
    ];
                        
    // Info window content
    var infoWindowContent = [

    ];
        
    // Add multiple markers to map
    var infoWindow = new google.maps.InfoWindow(), marker, i;
    
    // Place each marker on the map  
    for( i = 0; i < markers.length; i++ ) {

        var position = new google.maps.LatLng(markers[i][1], markers[i][2]);

        
        marker = new google.maps.Marker({
            
            position: position,
            map: map,
      icon: markers[i][3],
            title: markers[i][0]
        });
        
        // Add info window to marker    
        google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
                infoWindow.setContent(infoWindowContent[i][0]);
                infoWindow.open(map, marker);
            }
        })(marker, i));

        

    }

    // Set zoom level
    var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
        this.setZoom(12);

        google.maps.event.removeListener(boundsListener);
    });
}

// Load initialize function
google.maps.event.addDomListener(window, 'load', initMap);

</script>

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
          


        </div>
           
        </div>


    <?php
    include 'config/scripts.php';
    ?>
</body>

</html>
