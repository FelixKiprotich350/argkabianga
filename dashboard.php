<?php
session_start();
include 'config/server.php';

if (empty($_SESSION["user_id"])) {

  header("location: login");
}

if (empty($_SESSION["department_id"])) {

  header("location: login");
}

if (isset($_SESSION["user_id"]) != '') {
  $_SESSION['user_id'];
  $user_id = $_SESSION['user_id'];
}
if (isset($_SESSION["department_id"])) {
  $_SESSION['department_id'];
  $department_id = $_SESSION['department_id'];
}


global $message;

$sql_map = "SELECT * FROM sent_information";
$result_map = mysqli_query($db, $sql_map);

$result2 = $db->query("SELECT * FROM sent_information");

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

  include 'config/init_map_dash.php';

  ?>

  <style type="text/css">
    #mapCanvas {
      width: 100%;
      height: 500px;
    }
  </style>

</head>

<body>


  <aside id="left-panel" class="left-panel">
    <?php
    include 'config/side_bar.php';
    ?>
  </aside>

  <header>
    <div id="right-panel" class="right-panel">

      <?php
      include 'config/header.php';
      ?>
      <!--</div>-->

      <div class="content"> 
        <div id="mapCanvas">
          <label><?php echo $message; ?></label>
        </div>

      </div>

    </div>

    <?php
    include 'config/scripts.php';
    ?>
</body>

<script type="text/javascript">
  $(document).ready(function () {
    $('#sub_county').change(function () {

      var subcounty_id = $(this).val();
      $.ajax({
        url: "fetch_ward.php",
        method: "POST",
        data: { subcountyId: subcounty_id },
        dataType: "text",
        success: function (data) {
          $('#ward').html(data);
        }
      });
    });
  });
</script>

</html>