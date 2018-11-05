<?php

function formatX(float $val){
  return sprintf("%01.4f", ((($val+1)/2)*1));
}

function formatY(float $val){
  return sprintf("%01.4f", ((($val-1)/2)*-1));
}

include 'settings.php';

$db = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (!$db) {
  echo "Error: Unable to connect to MySQL." . PHP_EOL;
  echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
  echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
  exit;
}

echo "Connected" . PHP_EOL;

// fetch focalpoint assets
if( $fp_records = mysqli_query($db, "SELECT assetId, focusX, focusY FROM ". $fp_table_name)) {
  printf("Select returned %d rows.\n", mysqli_num_rows($fp_records));
  while($row = mysqli_fetch_assoc($fp_records)){
    $craftformatted_point = formatX($row['focusX']).":".formatY($row['focusY']);
    $assetID = $row['assetId'];
    if(mysqli_query($db, "UPDATE ".$asset_table_name." SET focalPoint = '".$craftformatted_point."' WHERE id = ".$assetID)){
      printf("Updated asset: %s to %s\n", $assetID, $craftformatted_point);
    } else {
      echo "Error updating record: " . mysqli_error($db) ."\n";
    }
  }
}


mysqli_close($db);

?>