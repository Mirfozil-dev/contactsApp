<?php
header('Content-type:application/json;charset=utf-8');
include 'db.php';

$contacts = mysqli_query($conn, 'SELECT * FROM contacts');

if ($contacts->num_rows > 0) {
  $result = [];
  while ($item = mysqli_fetch_array($contacts)) {
    $result[] = $item;
  }

  echo json_encode($result);
} else {
  echo json_encode([]);
}