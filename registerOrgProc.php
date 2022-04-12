<?php
      require("dbConnection.php");

      if($_SERVER["REQUEST_METHOD"] == "POST"){

        if(isset($_POST["orgName"]) && isset($_POST["address"])){
            $orgName = $_POST["orgName"];
            $orgAddress = $_POST["address"];

        //retrieve all organization data
        $duplicateQuery = "SELECT  orgName FROM organization WHERE orgName = '$orgName'";
        $duplicate = $con->query($duplicateQuery);
        $fetchDuplicate = $duplicate->fetch_all(MYSQLI_ASSOC);

        if(count($fetchDuplicate) != 0){
          echo"<script>alert('Organization has existed')</script>";
        }
        else{
          $insertNewQuery = "INSERT INTO organization (OrgName, OrgAddress) VALUES ('$orgName', '$orgAddress')";
          $insertNew = $con -> query($insertNewQuery);

          if($insertNew == TRUE){
            echo"<script>alert('Successfully Registered')</script>";
          }

        }
      }
        }
      $con->close();
    ?>