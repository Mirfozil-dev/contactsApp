<?php
include 'db.php';
header('Content-type:application/json;charset=utf-8');
$_POST = json_decode(file_get_contents('php://input'), true);

if (isset($_POST)) {
  if (isset($_POST['name']) && isset($_POST['number'])) {
    $result = mysqli_query($conn, "INSERT INTO contacts(name, number) VALUES ('{$_POST['name']}', '{$_POST['number']}')");
    if ($result) {
      echo json_encode("Contact has not been added!");
    } else {
      echo json_encode("Contact has not been added!");
    }
  }

}