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
        <?php if($result->num_rows > 0){ 
            while($row = $result->fetch_assoc()){ 
                //echo '["'.$row['name'].'", '.$row['latitude'].', '.$row['longitude'].', "'.$row['icon'].'"],'; 
                //echo '["'.$row['name'].'", '.$row['latitude'].', '.$row['longitude'].', "'.'images/paid.png'.'"],'; 
                $balance=$row['balance'];
                $department_id=$row['department_id'];
                $facility_type_id=$row['facility_type_id'];
                
                /*if($balance>0){
                    echo '["'.$row['facility_name'].'", '.$row['latitude'].', '.$row['longitude'].', "'.$row['icon'].'"],';
                }else if($balance==0){
                    echo '["'.$row['facility_name'].'", '.$row['latitude'].', '.$row['longitude'].', "'.'images/paid.png'.'"],'; 
                }*/
                /*if($department_id==1){
                    echo '["'.$row['facility_name'].'", '.$row['latitude'].', '.$row['longitude'].', "'.'images/ict.png'.'"],'; 
                }
                if($department_id==2){
                    echo '["'.$row['facility_name'].'", '.$row['latitude'].', '.$row['longitude'].', "'.'images/cattle.png'.'"],'; 
                }

                if($department_id==3){
                    echo '["'.$row['facility_name'].'", '.$row['latitude'].', '.$row['longitude'].', "'.'images/school.png'.'"],'; 
                }

                if($department_id==4){
                    echo '["'.$row['facility_name'].'", '.$row['latitude'].', '.$row['longitude'].', "'.'images/environment.png'.'"],'; 
                }*/

                if($department_id==5 && $balance==0){
                    echo '["'.$row['facility_name'].'", '.$row['latitude'].', '.$row['longitude'].', "'.'images/paid.png'.'"],'; 
                }
                if($department_id==5 && $balance!=0){
                    echo '["'.$row['facility_name'].'", '.$row['latitude'].', '.$row['longitude'].', "'.$row['icon'].'"],';
                }

                else{
                    echo '["'.$row['facility_name'].'", '.$row['latitude'].', '.$row['longitude'].', "'.'images/county_icon3.png'.'"],'; 
                }

                /*if($department_id==6){
                    echo '["'.$row['facility_name'].'", '.$row['latitude'].', '.$row['longitude'].', "'.'images/hospital.png'.'"],'; 
                }
                if($department_id==7){
                    echo '["'.$row['facility_name'].'", '.$row['latitude'].', '.$row['longitude'].', "'.'images/hospital.png'.'"],'; 
                }
                if($department_id==8){
                    echo '["'.$row['facility_name'].'", '.$row['latitude'].', '.$row['longitude'].', "'.'images/hospital.png'.'"],'; 
                }
                if($department_id==9){
                    echo '["'.$row['facility_name'].'", '.$row['latitude'].', '.$row['longitude'].', "'.'images/hospital.png'.'"],'; 
                }
                if($department_id==10){
                    echo '["'.$row['facility_name'].'", '.$row['latitude'].', '.$row['longitude'].', "'.'images/hospital.png'.'"],'; 
                }*//*else{
                    echo '["'.$row['facility_name'].'", '.$row['latitude'].', '.$row['longitude'].', "'.'images/county_icon.png'.'"],'; 
                }*/



              
                
                
            } 
        }
        ?>
    ];
                        
    // Info window content
    var infoWindowContent = [
        <?php if($result2->num_rows > 0){ 
            while($row = $result2->fetch_assoc()){ 

                $fac_id=$row['id'];
                $image_name=$row['image_name'];

                ?>
                [
                '<div class="info_content">' +
                '<img src="profile/<?php echo $image_name; ?>.jpg" style="width: 50px; height: 50px;">' +
                '<h4><?php echo $row['facility_name']; ?></h4>' +
                '<h5>Facility Type :<?php echo $row['facility_type']; ?></h5>' +
                '<h5>Physical Location : <?php echo $row['physical_location']; ?></h5>' +
                '<h5>Road/Street : <?php echo $row['road_street']; ?></h5>' + 
                '<form method="get" action="facility_type_edit">'+
                '<input type="hidden" name="id" value="<?php echo $fac_id; ?>">'+
                          '<input type="submit" value="Edit" class="btn btn-info">'+
                      '</form>'+

                '</div>'],
        <?php } 
        } 
        ?>
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
        this.setZoom(17);

        google.maps.event.removeListener(boundsListener);
    });
}

// Load initialize function
google.maps.event.addDomListener(window, 'load', initMap);

</script>