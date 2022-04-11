<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Organization Registration</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="HELPaid.ico" rel="icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">  
  <link href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.0/css/boxicons.min.css" rel='stylesheet'>
  <link href="assets/css/style.css" rel="stylesheet">

</head>
  
<body>
  <div class="wrap">
    <!-- ======= Header ======= -->
    <header id="header" class="d-flex align-items-center">
        <div class="container-fluid d-flex align-items-center justify-content-between">
  
          <div class="logo">
            <h1 class="text-light"><a href="index.html"><span>HELP Aid</span></a></h1>
          </div>
  
          <nav id="navbar" class="navbar">
            <ul>
              <li><a class="nav-link scrollto active" href="#main">Organization Registration</a></li>
              <li><a class="nav-link scrollto" href="admin.html">Representative Registration</a></li>
              <li><a class="nav-link scrollto" href="index.html">Logout</a></li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
          </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->

    <?php
      //create database connection
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
            echo"<script>alert('Successfully Registered');window.location.href= 'admin.php';</script>";
            
          }

        }
      }
    }
    $con->close();
    ?>

    <main id="main">
      <section class="inner-page">
        <h2 class="text-center">Register Organization</h2>
        <div class="container">
          <div class="card center-form">
            <div class="card-body">
            <form method="post" id="orgForm" class="mt-4" action="registerForOrg.php">
              <div class="row">
                <div class="col-3 form-group">
                  <label for="orgName" class="control-label">Organization Name: </label>
                </div>
                <div class="col-9">
                  <input type="text" name="orgName" class="form-control" id="orgName">
                </div>
              </div>
              
              <div class="row">
                <div class="col-3 form-group">
                  <label for="address" class="control-label">Address: </label>
                </div>
                <div class="col-9 form-group">
                  <textarea class="form-control" id="address" name="address"></textarea>
                </div>
              </div>
              
              <div class="row">
                <div class="form-group mt-3 mt-md-0">
                  
                  <a href="admin.php"><input type="submit" value="Submit" class="btn btn-default float-end"></a>
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
    </footer><!-- End Footer -->

  </div>


  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Javascript -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="assets/js/main.js"></script>
  <!--Register organization form validation-->
  <script>
    const orgForm = document.getElementById("orgForm");

    orgForm.addEventListener("submit", (e) => {
      e.preventDefault();
      if(validateOrgForm() == true){
        orgForm.submit();
      }
    });

    function validateOrgForm(){
      let orgName = orgForm.orgName.value;
      let address = orgForm.address.value;

      if(orgName == ""){
        alert("Please fill in the organization name!");
        return false;
      }
      else if(address == ""){
        alert("Please fill in the address!");
        return false;
      }
      else{
        return true;
      }
    }
  </script>
  
</body>


</html>
