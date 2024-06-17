<div class="form-group">
  <?php
  $sql_department = "SELECT * FROM county_departments";
  $result_department = mysqli_query($db, $sql_department);
  ?>
  <select name="department_name" class="form-control" required>
    <option><?php echo $department_name; ?></option>
    <?php while ($row_department = mysqli_fetch_array($result_department)):
      ; ?>

      <option><?php echo $row_department['name']; ?></option>

    <?php endwhile; ?>

  </select>
  <?php

  ?>
</div>