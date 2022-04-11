<?php
session_start();
include("dbcon.php");


$username = $_SESSION['username'];

  
    $disbursement = "SELECT * FROM disbursement  WHERE username = '$username'";

    $result = $connection->query($disbursement);
    if($result -> num_rows > 0)
    {
        $disbursement_data = $result -> fetch_assoc();
    }



if($_SERVER["REQUEST_METHOD"] == "POST"){
  $newStatus = $_POST['status'];
  if ($newStatus == "Received"){
    $sql = "UPDATE disbursement SET status = '$newStatus' WHERE username = '$username'";
    $result = $connection->query($sql);
  } else {
    $sql = "UPDATE disbursement SET status = 'Not Received' WHERE username = '$username'";
    $result = $connection->query($sql);
  }
  
}

header("location:applicantDashboard.php")
?>