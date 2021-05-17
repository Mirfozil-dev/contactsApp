<?php
include 'db.php';
header('Content-type:application/json;charset=utf-8');
$_POST = json_decode(file_get_contents('php://input'), true);


if (isset($_POST)) {
  if (isset($_POST['id'])) {
    $id = json_decode($_POST['id']);
    $result = mysqli_query($conn, "DELETE FROM contacts WHERE id = ".$id);
    if ($result) {
      echo json_encode("Contact with id ".$id." has been deleted!");
    } else {
      echo json_encode("Contact has not been deleted!");
    }
  }
}