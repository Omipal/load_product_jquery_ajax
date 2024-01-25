<?php
include('dbcon.php');

if (isset($_POST['brand_id'])) {

  $brand_id = $_POST['brand_id'];

  if ($brand_id != '') {
    $query = "select * from product where brand_id  = '$brand_id'";
  } else {
    $query = "select * from product";
  }
  $run = mysqli_query($con, $query);

  $output = '';

  while ($row = mysqli_fetch_array($run)) {
    $output .= " <div class='col-sm-3 mt-3'>";
    $output .= " <div class='card card-body bg-info'><h5>$row[1]</h5> <h6>$row[2]</h6>";
    $output .= "</div>";
    $output .= "</div>";
  }

  echo $output;
}
