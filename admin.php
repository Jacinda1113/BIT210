
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Admin</title>
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

        <!--Choose organization ID-->
        <div class="container">
          <div class="row">
            <div class="text-center">
              <h3 class="fw-bold mt-3">Welcome, Admin!</h3>
              <form id="orgForm" method="POST" action="admin.php">
              <label for="orgID"> Organization ID:</label>
              <select name="orgID" id="orgID" class="form-select row" onchange="displaySelectedID();">
                <option value="-1">Select an organization ID</option>
                <?php
                  require('dbconnection.php');
                  $sqlquery ="SELECT * FROM organization";
                  $ret = mysqli_query($con, $sqlquery);
                  $options = "";

                  while($row = mysqli_fetch_array($ret))
                  {
                    $options = $options."<option value ='$row[1]'>$row[0]</option>";    
                  }
                  echo "$options";
                ?>              
              </select>
            <div class="text-center" name=orgID id="displayOrgID"></div>
            <div class="text-center" id="displayOrgName"></div>
            <br><br>
            <div class="col-md-12 text-center">
              <input type="button" value="Register Representative" onclick="inputOrgID();" class="btn btn-sm btn-default" data-target="#orgRep" data-toggle="modal">
            </div>
            </form>
            </div>
          </div>
        </div>
        
       <!-- php For Organisation Representative Form-->
        <?php
        //create database connection
        require("dbConnection.php");
        
        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
          if(isset($_POST["orgID"]) && ($_POST["username"]) && isset($_POST["password"])&& isset($_POST["fullname"]) && isset($_POST["email"]) && isset($_POST["mobile"]) && isset($_POST["jobTitle"]))
          {
            $org_ID = $_POST["orgID"];
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
              echo"<script>alert('Username has been used. Please use another username';orgRepForm.username.focus();)</script>";
            }
            else{
              $insertNewQuery = "INSERT INTO user (username, password, fullname,email, mobileNo,jobTitle, OrgID, userType)
              VALUES ('$user_name','$pwd', '$full_name','$user_email','$mobile_no','$job_title', '$org_ID' ,'ORG_REP')";
              $insertNew = $con -> query($insertNewQuery);
              $resultquery = $insertNew ===TRUE;
              echo "<script>alert({$resultquery})</script>";
              if($insertNew ==TRUE){
                echo"<script>alert('Successfully Registered! Please check your email for default password.');</script>)";
              }
            }
            $con->close();
          }
          
      }
        ?>
        <!-- Modal HTML Markup For Organisation Representative Form-->
       
        <div class="modal fade" id="orgRep">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-xs-center">Organization Representative</h4>
                </div>
                <div class="form-area modal-body">
                    <form id="orgRepForm" method="POST" action="admin.php" >
                      <div class="form-group row">
                        <div>
                          <label for="orgID">Organization ID: </label>
                          <span id="selectedOrgID"></span>
                        </div>
                        <!--Default Password for the organisation Representative-->
                        <input hidden type="text" id="password" name="password">
                        
                        <div class="col-12">
                          <label for="username" class="control-label">User Name: </label>
                        </div>
                        <div class="col-12">
                            <input type="text" class="form-control" value=""  id="username" name="username" placeholder="User Name" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-12">
                          <label for="fullname" class="control-label">Full name: </label>
                        </div>
                        <div class="col-12">
                            <input type="text" class="form-control" value="" id="fullname" name="fullname"  placeholder="Full Name" required> 
                        </div>
                        
                      </div>
                        <div class="form-group row">
                          <div class="col-12">
                            <label for="username" class="control-label">Email: </label>
                          </div>
                          <div class="col-12">  
                            <input type="email" value="" class="form-control" name="email" id="email" placeholder="Your Email" required>
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-12">
                            <label for="mobile" class="control-label">Mobile number: </label>
                          </div>
                          <div class="col-12">
                            <input class="form-control" value="" id="mobile" name="mobile" type="tel" placeholder="+6012 1212 3458" required>
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-12">
                            <label for="jobTitle" class="control-label">Job Title:</label>
                          </div>
                            <div class="col-12">
                                <input class="form-control" value="" id="jobTitle" name="jobTitle" type="text" placeholder="Job Title" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                          <button class="btn btn-default btn-sm" data-toggle="modal" data-target="#orgRep" data-dismiss="modal" onclick="submitMoreForm()">More Representative</button>
                          <button class="btn btn-default btn-sm" data-dismiss="modal" onclick="submitForm()">Submit Now</button>
                      </div>

                    </form>
                    </div>
                  </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
              </div><!-- /.modal -->     
                          
  

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

<!-- Bootstrap javascript -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<!-- Vendor JS Files -->
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Template Main JS File -->
<script src="assets/js/main.js"></script>

    <!--JS file-->
    <script src="admin.js"></script>
</body>

</html>
