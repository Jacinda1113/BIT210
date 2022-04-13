<?php session_start();
include("dbconnection.php");
$orgID = $_SESSION['OrgID'];


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Aid Appeal</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="HELPaid.ico" rel="icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <!-- Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!--JS file-->
  <script src="aidAppeal.js"></script>

</head>

<body>
  <div class="wrap">

    <!-- ======= Header ======= -->
    <header id="header" class="d-flex align-items-center">
        <div class="container d-flex align-items-center justify-content-between">
  
          <div class="logo">
            <h1 class="text-light"><a href="homepage.php"><span>HELP Aid</span></a></h1>
          </div>
  
          <nav id="navbar" class="navbar">
            <ul>
              <li><a class="nav-link scrollto" href="orgRepDashboard.php">Home</a></li>
              <li><a class="nav-link scrollto" href="recordContribution.php">Record Contribution</a></li>
              <li><a class="nav-link scrollto" href="registerApplicant.php">Applicant Registration</a></li>
              <li><a class="nav-link scrollto " href="aidAppeal.php">Record New Appeal</a></li>
              <li><a class="nav-link scrollto " href="aidDisbursement.php">Record Aid Disbursement</a></li>
              <li><a class="nav-link scrollto " href="AidDelivered.php">Package Status</a></li>
              <li><a class="nav-link scrollto " href="logout.php">Logout</a></li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
          </nav><!-- .navbar -->

  
        </div>
    </header><!-- End Header -->

    <main id="main">
      <!-- ======= Breadcrumbs ======= -->
      <section class="breadcrumbs">
        <div class="container">
          <div class="d-flex justify-content-between align-items-center">
            <h2>Record New Appeal</h2>
          </div>
        </div>
      </section><!-- End Breadcrumbs -->

      <section class="inner-page">
        <h2 class=text-center>Appeal Form</h2>
        <div class="container">
          <div class="card center-form">
            <!--Add Appeal Form-->
            <div class="card-body">
            <?php
              //count total number of appeal
              $appealQuery = "select * from appeal";
              $appeals = $con ->query($appealQuery);
              $noOfappeal = mysqli_num_rows($appeals);
              echo"<script>var numOfAppeals = {$noOfappeal};
              console.log(numOfAppeals)</script>";

              //   //create database connection
              // require("dbConnection.php");
              //check if the form sending data
              if($_SERVER["REQUEST_METHOD"] == "POST"){

                if(isset($_POST["fDate"]) && isset($_POST["tDate"]) && isset($_POST["description"]) && isset($_POST["appealID"]))
                {
                  $from_date = $_POST["fDate"];
                  $to_date = $_POST["tDate"];
                  $appeal_description = $_POST["description"];
                  $appeal_ID =$_POST["appealID"];

 
                    $insertNewQuery = "INSERT INTO appeal (appealID, fromDate, toDate,description,orgID)
                    VALUES ('$appeal_ID','$from_date','$to_date','$appeal_description',$orgID)";
                    $insertNew = $con -> query($insertNewQuery);

                    if($insertNew ==TRUE){
                      echo"<script>alert('Appeal successfully recorded!');</script>";
                    }
                }

                
              }
              ?>

                <form method="post" id="appealForm" action="aidAppeal.php" onsubmit="getappealID()">
                    <div class="row">
                      <div class="col-md-6 form-group">
                        <!--Appeal ID -->
                        <input type="text" id="appealID" name="appealID" hidden>

                        <label class="control-label" for="fdate">From Date:</label>
                        <input class="form-control" type="date" id="fdate" name="fDate"onchange="setDateLimit(this)">
                      </div>
                      <div class="col-md-6 form-group">
                        <label class="control-label" for="tdate">To Date:</label>
                        <input class="form-control" type="date" id="tdate" name="tDate">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-10 form-group">
                        <label class="col-md-2 control-label" for="description">Description </label>
                        <input class="form-control col-md-9" type="text" name="description" id="description">
                      </div>
                      <div class="col-md-2 form-group">
                        <br>
                        <input type="submit" id="submitAppealDes" class="btn btn-default">
                      </div>
                    </div>
                </form> 
            </div>
          </div>
        </div>
      </section>

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer">
      <div class="footer-top">
        <div class="container">
          <div class="row">

            <div class="footer-contact">
              <h3>HELP Aid</h3>
              <p>
                1 Jalan Pjs 11/15 Bandar Sunway <br>
                Petaling Jaya, Selangor 46150<br>
                Malaysia <br><br>
                <strong>Phone:</strong> +60 1134 2322<br>
                <strong>Email:</strong> helpaid@support.com<br>
              </p>
            </div>

          </div>

          <div class="row">
            <div class="social-links mt-3 text-center">
              <a href="https://www.twitter.com" class="twitter"><i class="bx bxl-twitter"></i></a>
              <a href="https://www.facebook.com" class="facebook"><i class="bx bxl-facebook"></i></a>
              <a href="https://www.instagram.com" class="instagram"><i class="bx bxl-instagram"></i></a>
            </div>
          </div>
        </div>
      </div>

      <div class="container py-4">
        <div class="copyright">
          &copy; Copyright <strong><span>HELP Aid</span></strong>. All Rights Reserved
        </div>
      </div>
    </footer>
    <!-- End Footer -->

  </div>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Bootstrap javascript -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
 
  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  
</body>

</html>
