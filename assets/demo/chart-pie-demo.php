<?php 
  $query = mysqli_query($conn, "SELECT SUM(l_amount) FROM load_tracker WHERE l_deleted != 1
                                  UNION
                                  SELECT SUM(t_amount) FROM transportation_tracker WHERE t_deleted != 1
                                  UNION
                                  SELECT SUM(d_amount) FROM delivery_tracker WHERE d_deleted != 1;");
?>

<script>
  // Set new default font family and font color to mimic Bootstrap's default styling
  Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
  Chart.defaults.global.defaultFontColor = '#292b2c';

  // Pie Chart Example
  var ctx = document.getElementById("myPieChart");
  var myPieChart = new Chart(ctx, {
      type: 'pie',
      data: {
      labels: ["Load", "Transportation", "Delivery"],
      datasets: [{
          data: [
              <?php
                  while($row = mysqli_fetch_array($query)){
                      echo '"'.$row['SUM(l_amount)'].'",';
                  }
              ?>
          ],
          backgroundColor: ['#031166', '#FEE6AA', '#59E1DA'],
      }],
      },
  });
</script>