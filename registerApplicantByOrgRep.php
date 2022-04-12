<?php session_start();?>
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
    //count no of applicant
    $applicant = "SELECT * FROM User WHERE userType = 'APPLICANT'";
    $allApplicant = $con->query($applicant);
    $noOfApplicant = mysqli_num_rows($allApplicant);
    echo"<script>var noOfApplicant = {$noOfApplicant}; </script>";

    //count no of document
    $document = "SELECT * FROM Document";
    $allDocs = $con->query($document);
    $noOfDocs = mysqli_num_rows($allDocs);
    echo"<script>var noOfDocs = {$noOfDocs}; </script>";
    
    $con->close();
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
              <li><a class="nav-link scrollto" href="orgRepDashboard.php">Home</a></li>
              <li><a class="nav-link scrollto" href="recordContribution.php">Record Contribution</a></li>
              <li><a class="nav-link scrollto active" href="registerApplicantByOrgRep.php">Applicant Registration</a></li>
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
            <ol>
              <li><a href="orgRepDashboard.php">Home</a></li>
              <li>Applicant Registration</li>
            </ol>
          </div>
        </div>
      </section><!-- End Breadcrumbs -->

      <section class="inner-page">
        <div class="container">
            <div class="row">
                <div class="card text-center w-50" id="notif">
                    <div class="card-header">
                        <div id="applicant_details_header">
                            Applicant Registration
                        </div>
                        <div id="upload_document_header" hidden>
                            Upload Document
                        </div>
                    </div>
                    <div class="card-body">
                        <form id="applicant_form" action="addDocByOrgRep.php" method="POST">
                            <input type="text" id="username" name="username" hidden>
                            <input type="text" id="password" name="password" hidden>
                            
                            <!--Applicant Details Form-->
                            <div id="applicant_details">
                                <!--Full Name-->
                                <div class="form-group row">
                                    <div class="col-4">
                                        <label class="control-label">Full Name</label>
                                    </div>
                                    <div class="col-8">
                                        <input type="text" id="name" name="name" class="form-control" placeholder="Please enter the fullname">
                                    </div>
                                </div>

                                <!--ID No-->
                                <div class="form-group row">
                                    <div class="col-4">
                                        <label class="control-label">ID No</label>
                                    </div>
                                    <div class="col-8">  
                                        <input type="text" id="idNo" name="idNo" class="form-control" placeholder="Please enter the ID Number">
                                    </div>
                                </div>

                                <!--Address-->
                                <div class="form-group row">
                                    <div class="col-4">
                                        <label class="control-label">Address</label>
                                    </div>
                                    <div class="col-8">
                                        <input type="text" id="address" name="address" class="form-control" placeholder="Please enter the address">
                                    </div>
                                </div>

                                <!--Income-->
                                <div class="form-group row">
                                    <div class="col-4">
                                        <label class="control-label">Household Income</label>
                                    </div>
                                    <div class="col-8">
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1">RM</span>
                                            <input type="number" class="form-control" id="income" name="income" aria-label="Income" aria-describedby="basic-addon1" placeholder="450.50">
                                        </div>
                                    </div>
                                </div>

                                <!--Next Button-->
                                <button id="registNext" type="button" class="btn btn-default" onclick="registerNextBtnOrg()">Next</button>
                            </div>
                                
                            <!--Upload Document Form-->
                                <div id="upload_document" hidden>
                                    <input type="text" id="docID" name="documentID" hidden>
                                    <!--File Name-->
                                    <div class="form-group row">
                                        <div class="col-4">
                                            <label class="control-label">File Name</label>
                                        </div>
                                        <div class="col-8">
                                            <input type="text" id="fileName" name="filename" class="form-control" placeholder="example.pdf">
                                        </div>
                                    </div>

                                    <!--Description-->
                                    <div class="form-group row">
                                        <div class="col-4">
                                            <label class="control-label">Description</label>
                                        </div>
                                        <div class="col-8">  
                                            <input type="text" id="description" name="desc" class="form-control" placeholder="Please enter the file description">
                                        </div>
                                    </div>

                                    <!--Upload Document File-->
                                    <div class="form-group row">
                                        <div class="col-4">
                                            <label class="control-label">Upload Document</label>
                                        </div>
                                        <div class="col-8">
                                            <input type="file" id="doc" class="form-control" accept="application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document">
                                        </div>
                                    </div>

                                    <!--Button-->
                                    <button id="registBack" type="button" class="btn btn-default" onclick='showApplicantDetailsFormOrg()'>Back</button>
                                    <button id="checkForm" type="button" class="btn btn-default" onclick='registBtnOrg()'>Submit</button>
                            </div>
                                
                        </form>
                    </div>
                </div>

                <!-- Modal HTML Markup For Add Document Confirmation-->
                <div class="modal fade" id="addDocumentConfirm">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title text-xs-center">Succssfully Uploaded</h4>
                            </div>
                            <div class="modal-body">
                                <p>Do you want to upload another document?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default btn-sm" id="addDoc" onclick='submitForm()'>Yes</button>
                                <button type="button" class="btn btn-default btn-sm" id="notAdd" onclick='submitLast()'>No</button>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="assets/js/main.js"></script>
  <script src="assets/js/registerApplicantByOrgRep.js"></script>

  

  <script>
    const applicantForm = document.getElementById("applicant_form");
  </script>

</body>

</html>
