  <?php

  include 'config/server.php';

  if (isset($_POST['btn_export'])) {

      $output = '';
      $facility_name=$_POST['facility_name'];

        $sql= "SELECT * FROM county_facilities WHERE name='$facility_name'";
              $result=mysqli_query($db,$sql);

              if (mysqli_num_rows($result)!=0) {
                  
                  while ($row=mysqli_fetch_assoc($result)) {
                      
                      $facility_id=$row['id'];

                    }
                  }

                  //
$query_1 = "SELECT * FROM locations WHERE facility_type_id='$facility_id'";
 $result_1 = mysqli_query($db, $query_1);
 if(mysqli_num_rows($result_1) > 0)
 {
  $output .= '
   <table class="table" bordered="1">  
                    <tr>  
                         <th></th>  
                         <th></th>
                         <th></th>
                         <th></th>
                         <th></th>
                         <th></th>
                         <th></th>
                         <th></th>
                         <th></th>
                         <th></th>
                    </tr>
  ';
  while($row_1 = mysqli_fetch_array($result_1))
  {
   $output .= '
    <tr>  
                         <td>'.$row_1["facility_name"].'</td>  
                         <td>'.$row_1["facility_type"].'</td>
                         <td>'.$row_1["sub_county"].'</td>
                         <td>'.$row_1["ward"].'</td>
                         <td>'.$row_1["physical_location"].'</td>
                         <td>'.$row_1["road_street"].'</td>
                         <td>'.$row_1["description"].'</td>
                         <td>'.$row_1["remarks"].'</td>
                         <td>'.$row_1["latitude"].'</td>
                         <td>'.$row_1["longitude"].'</td>
                    </tr>
   ';
  }
  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=download.xls');
  echo $output;
 }
                  //

     
}
?>