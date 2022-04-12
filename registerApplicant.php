<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Applicant Registration</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="HELPaid.ico" rel="icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!--CSS Files-->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">  
    <link href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.0/css/boxicons.min.css" rel='stylesheet'>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">

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

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $username = $_POST["username"];
        $password = $_POST["password"];
        $name = $_POST["name"];
        $idNo = $_POST["idNo"];
        $address = $_POST["address"];
        $income = $_POST["income"];
        $documentID = $_POST["documentID"];
        $filename = $_POST["filename"];
        $desc = $_POST["desc"];
        $orgID = $_POST["orgID"];

        $_SESSION["username"] = $_POST["username"];
            
            //check if got duplicate
            $duplicate = "SELECT * FROM user where idNo = '$idNo'";
            $result = $con->query($duplicate);
            $fetchResult = $result->fetch_all(MYSQLI_ASSOC);

            if(count($fetchResult) == 0){
                //insert into user table
                $insertApplicant = "INSERT INTO user (username, password, fullname, idNo, applicantAddress, householdIncome, OrgID, userType) 
                VALUES ('$username', '$password', '$name', '$idNo', '$address', '$income', '$orgID', 'APPLICANT')";
                $queryInsert = $con->query($insertApplicant);
                $insertDoc = "INSERT INTO document VALUES ('$documentID', '$filename', '$desc', '$username')";
                $adDoc = $con->query($insertDoc);
            }
            else{
                echo "<script>alert('ID Number Has Been Used');window.location.href='homepage.php';</script>";
            }
    }
?>

  <div class="wrap">

    <!-- ======= Header ======= -->
    <header id="header" class="d-flex align-items-center">
        <div class="container d-flex align-items-center justify-content-between">
  
          <div class="logo"> 
            <h1 class="text-light"><a href="homepage.php"><span>HELP Aid</span></a></h1>
          </div>
  
          <nav id="navbar" class="navbar">
            <ul>
              <li><a class="nav-link scrollto" href="homepage.php">Home</a></li>
              <li class="dropdown"><a href="#"><span>Appeals</span> <i class="bi bi-chevron-down"></i></a>
                <ul>
                  <li><a href="currentAppeal.php">Current Appeals</a></li>
                  <li><a href="pastAppeal.php">Past Appeals</a></li>
                </ul>
              </li>
              <li><a class="nav-link scrollto active" href="selfRegistration.php">Applicant Registration</a></li>
              <li><a class="nav-link scrollto " href="login.php">Login</a></li>
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
                    <p>Registration Completed</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <i class="fa fa-check-circle" style="font-size:120px;color:#4eb478"></i>
                        </div>
                        <div class="row">
                            <p>Applicant Registered Successfully</p>
                        </div>
                        <button class="btn btn-default btn-sm" id="notAdd" onclick="redirect()">Back to Home</button>
                    </div>
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
    </footer><!-- End Footer -->
</div>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Javascript -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="assets/js/main.js"></script>

  <script>
    //function to redirect to home page
    function redirect(){
        window.location.href = "homepage.php";
    }
  </script>

</body>

</html>
