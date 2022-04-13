<?php
session_start();
include("dbconnection.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Add More Representative</title>
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

  <!-- Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  
  <!--JS file-->
  <script src="admin.js"></script>
  <style>
      #notif{
        margin: auto;
        padding: 0;
      }
    </style>
</head>

<body>

<?php
    require('dbConnection.php');
        
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $_SESSION["orgID"] = $_POST["orgID"];
      if(isset($_POST["orgID"]) && ($_POST["username"]) && isset($_POST["password"])&& isset($_POST["fullname"]) && isset($_POST["email"]) && isset($_POST["mobile"]) && isset($_POST["jobTitle"]))
      {
        $orgID = $_SESSION['orgID'];
        $user_name = $_POST["username"];
        $pwd = $_POST["password"];
        $full_name = $_POST["fullname"];
        $user_email = $_POST["email"];
        $mobile_no = $_POST["mobile"];
        $job_title = $_POST["jobTitle"];
        
        //insert to document table
        $insertNewQuery = "INSERT INTO user (username, password, fullname,email, mobileNo,jobTitle, OrgID, userType)
        VALUES ('$user_name','$pwd', '$full_name','$user_email','$mobile_no','$job_title', '$orgID' ,'ORG_REP')";
        $insertNew = $con -> query($insertNewQuery);
        $resultquery = $insertNew ===TRUE;
      }
        $con->close();
    }
?>

<div class="wrap">

<!-- ======= Header ======= -->
<header id="header" class="d-flex align-items-center">
    <div class="container-fluid d-flex align-items-center justify-content-between">

      <div class="logo">
        <h1 class="text-light"><a href="homepage.php"><span>HELP Aid</span></a></h1>
      </div>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto" href="registerForOrg.php">Organization Registration</a></li>
          <li><a class="nav-link scrollto " href="admin.php">Representative Registration</a></li>
          <li><a class="nav-link scrollto" href="homepage.php">Logout</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
    
</header><!-- End Header -->

    <main id="main">

      <section class="inner-page">
        <div class="container">
            <div class="row align-items-center">
                <div class="card text-center w-50" id="notif">
                    <div class="card-header">
                    <p>Representative Registration Completed</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <i class="fa fa-check-circle" style="font-size:120px;color:#4eb478"></i>
                        </div>
                        <div class="row">
                            <p>All Representatives Registered Successfully</p>
                        </div>
                        <button class="btn btn-default btn-sm" id="notAdd" onclick="redirect()">Back to Home</button>
                    </div>
                    </div>
                </div>
            </div>
    
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
    </footer><!-- End Footer -->
</div>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Javascript -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script src="assets/js/main.js"></script>

  <script>
    //function to redirect to home page
    function redirect(){
        window.location.href = "homepage.php";
    }
  </script>

</body>

</html>
