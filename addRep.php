<?php session_start();
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

  <!--CSS Files -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">  
  <link href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.0/css/boxicons.min.css" rel='stylesheet'>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">

  <!--JS file-->
  <script src="admin.js"></script>

</head>

<body>
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

        <!-- php For Organisation Representative Form-->
        <?php
        //create database connection
        require("dbConnection.php");
        
        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            $_SESSION["orgID"] = $_POST["orgID"];
            $orgID = $_SESSION['orgID'];
            $user_name = $_POST["username"];
            $pwd = $_POST["password"];
            $full_name = $_POST["fullname"];
            $user_email = $_POST["email"];
            $mobile_no = $_POST["mobile"];
            $job_title = $_POST["jobTitle"];

            //Cannot use that username if username already exists
            $duplicateUserName = "SELECT username FROM user WHERE username ='$user_name'";
            $duplicate = $con->query($duplicateUserName);
            $fetchDuplicate = $duplicate->fetch_all(MYSQLI_ASSOC);

            if(count($fetchDuplicate)>0){
              echo"<script>alert('Username has been used. Please use another username');</script>";
            }
            else{
              $insertNewQuery = "INSERT INTO user (username, password, fullname,email, mobileNo,jobTitle, OrgID, userType)
              VALUES ('$user_name','$pwd', '$full_name','$user_email','$mobile_no','$job_title', '$orgID' ,'ORG_REP')";
              $insertNew = $con -> query($insertNewQuery);
              $resultquery = $insertNew ===TRUE;
              if($insertNew ==TRUE){
                echo"<script>alert('Successfully Registered! Please check your email for default password.');</script>)";
              }
            }        
        }
        $con->close();   
      ?>

        <div class="container">
          <div class="card center-form">
            <div class="card-body">
            <form id="orgRepForm" method="POST" action="addRep.php">
            <h4 class="modal-title text-center">Organization Representative</h4> 
                <input type="text" id="orgID" name="orgID" hidden>
                <script>
                  document.getElementById("orgID").value = "<?php
                  if(!empty($_SESSION["orgID"])){
                      echo $_SESSION["orgID"];
                  }
                  else{
                    echo"";
                  }
                  ?>";
                </script>
                <input type="text" id="password" name="password" hidden>
                <script>
                  document.getElementById("password").value = passwordGenerator();
                </script>
                <div class="form-group row"> 
                  <div class="col-3">
                    <label for="username" class="control-label">User Name: </label>
                  </div>
                  <div class="col-6">
                      <input type="text" class="form-control" id="username" name="username" placeholder="User Name" required>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-3">
                    <label for="fullname" class="control-label">Full name: </label>
                  </div>
                  <div class="col-6">
                      <input type="text" class="form-control" id="fullname" name="fullname"  placeholder="Full Name" required> 
                  </div>
                  
                </div>
                  <div class="form-group row">
                    <div class="col-3">
                      <label for="username" class="control-label">Email: </label>
                    </div>
                    <div class="col-6">  
                      <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-3">
                      <label for="mobile" class="control-label">Mobile number: </label>
                    </div>
                    <div class="col-6">
                      <input class="form-control" id="mobile" name="mobile" type="tel" placeholder="+6012 1212 3458" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-3">
                      <label for="jobTitle" class="control-label">Job Title:</label>
                    </div>
                      <div class="col-6">
                          <input class="form-control" id="jobTitle" name="jobTitle" type="text" placeholder="Job Title" required>
                      </div>
                  </div>
                  <div class="modal-footer">
                    <button class="btn btn-default btn-sm" onclick="submitForm()">More Representative</button>
                    <button class="btn btn-default btn-sm"  onclick="endSubmission()">Submit</button>
                </div>
              </div>
            </form>
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
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="assets/js/main.js"></script>

</body>

</html>
