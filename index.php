<?php
include('dbcon.php');

function fillBrand($con)
{
  $output = "";

  $query = "select * from brand";
  $run = mysqli_query($con, $query);

  while ($row = mysqli_fetch_array($run)) {
    $output .= " <option value='$row[0]'>" . $row[1] . "</option>";
  }

  return $output;
}

function fillProducts($con)
{
  $output = "";

  $query = "select * from product";
  $run = mysqli_query($con, $query);

  while ($row = mysqli_fetch_array($run)) {
    $output .= " <div class='col-sm-3 mt-3'>";
    $output .= " <div class='card card-body bg-info'><h5>$row[1]</h5> <h6>$row[2]</h6>";
    $output .= "</div>";
    $output .= "</div>";
  }

  return $output;
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <h1 class="text-center bg-dark text-white p-5">Load records from database in php using jquery ajax</h1>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-3 mt-2">
        <select name="brand" id="brand" class="form-control">
          <option value="">Select Any Brand</option>
          <?php echo fillBrand($con); ?>
        </select>
      </div>
    </div>
    <div class="row mt-2" id="show_products">
      <?php echo  fillProducts($con); ?>
    </div>
  </div>


  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>
  <script>
    $(document).ready(function() {
      $("#brand").change(function() {
        const brand_id = $("#brand").val();
        if (brand_id != '') {
          $.ajax({
            url: 'load.php',
            type: 'post',
            data: {
              brand_id: brand_id
            },
            success: function(response) {
              $("#show_products").hide().fadeIn(1000);
              $("#show_products").html(response);
            }
          });
        }
      });

    });
  </script>
</body>

</html>