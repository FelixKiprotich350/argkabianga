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
                
                echo '["'.$row_map['description'].'", '.$row_map['latitude'].', '.$row_map['longitude'].', "'.$row_map['icon'].'"],'; 
                
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
                '<img src="images/<?php echo $image_name; ?>.jpg" style="width: 100px; height: 100px;">' +
                '<h4><?php echo $row['description']; ?></h4>' +
                '<h5>Date Sent:<?php echo $row['date_sent']; ?></h5>' +

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