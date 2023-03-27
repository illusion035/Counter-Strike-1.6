<!-- 
Page created by illusion 
-->

<?php 
    require('database.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!-- Заглавие на страницата -->
    <title>Title</title>

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css" />

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>

    <!-- DataTables Search Bar Plugin -->
    <script src="https://cdn.datatables.net/searchpanes/1.4.1/js/dataTables.searchPanes.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/searchpanes/1.4.1/css/searchPanes.bootstrap5.min.css" />

    <!-- Custom CSS -->
    <link href="assets/css/MyStyle.css" rel="stylesheet">

    <!-- Replacer ( For Bootstrap ) -->
    <link href="assets/css/Replacer.css" rel="stylesheet">

</head>

<body>

<!-- Content Here -->

<div class="table-responsive container mt-5">
  <table id="myTable" class="table table-dark table-striped text-center">
    <thead>
      <tr>
        <th><i class="fa-regular fa-user text-warning"></i> Player</th>
        <th><i class="fa-solid fa-angles-right text-warning"></i> XP</th>
        <th><i class="fa-solid fa-turn-up text-warning"></i> Level</th>
        <th><i class="fa-regular fa-circle-right text-warning"></i> Next XP</th>
        <th><i class="fa-regular fa-star text-warning"></i> Rank</th>
        <th><i class="fa-regular fa-star-half-stroke text-warning"></i> Next Rank</th>
      </tr>
    </thead>
    <tbody>
      <?php
    // Executing a query
    $sql = "SELECT * FROM ranksystem";
    $result = mysqli_query($conn, $sql);

    // Checking if the query returned any results
    if (mysqli_num_rows($result) > 0) {
        // Output data of each row
        while($row = mysqli_fetch_assoc($result)) {
          echo "<tr>";
          echo "<td>".$row["Player"]."</td>";
          echo "<td>".$row["XP"]."</td>";
          echo "<td>".$row["Level"]."</td>";
          echo "<td>".$row["Next XP"]."</td>";
          echo "<td>".$row["Rank"]."</td>";
          echo "<td>".$row["Next Rank"]."</td>";
          echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='3'>0 results</td></tr>";
    }

    // Closing the connection
    mysqli_close($conn);
  ?>
</tbody>
</table>
</div>
    </tbody>
  </table>
</div>
    
<!-- Content End -->

<script>
$(document).ready(function() {
  $('#myTable').DataTable();
});
</script>

<!-- Font Awesome Icons -->
<script src="https://kit.fontawesome.com/0afe5d78c1.js" crossorigin="anonymous"></script>

<!-- Popper JS -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>

<!-- Bootstrap Min JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    
</body>

</html>