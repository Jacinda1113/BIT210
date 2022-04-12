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
  <link href="assets/css/style.css" rel="stylesheet">

  <style>
    #ApplicantSubmit{
      margin-left : 5px;
    }
  </style>
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

      <!-- ======= Breadcrumbs ======= -->
      <section class="breadcrumbs">
        <div class="container">

          <div class="d-flex justify-content-between align-items-center">
            <h2>Choose Organization</h2>
            <ol>
              <li><a href="homepage.php">Home</a></li>
              <li>Applicant Registration</li>
            </ol>
          </div>
        </div>
      </section><!-- End Breadcrumbs -->

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
        ?>

      <section class="inner-page">
        <div class="container">
            <div class="row">

            <!--Organizations List Table-->
            <table class="table table-striped table-bordered text-center">
                    <tr>
                        <th>Organization Name</th>
                        <th></th>
                    </tr>

                    <?php
                      $SQL = "SELECT OrgID, OrgName from Organization";
                      $selectOrg = $con->query($SQL);
          
                      if($selectOrg){
                          if($selectOrg->num_rows == 0){
                              echo '<tr><td colspan = "2"> No Organization to Select </td></tr>';
                          }
                          else{
                              while($row = $selectOrg->fetch_assoc()){
                                  echo"<tr>
                                          <td>{$row['OrgName']}</td>
                                          <td>
                                              <button class='btn btn-default btn-sm' id='{$row['OrgID']}' type='button' data-toggle='modal' data-target='#applicantDetailsForm' onclick='getOrgID({$row['OrgID']})'>
                                                  SELECT
                                              </button>
                                          </td>
                                      </tr>";
                              }
                          }
                      }

                      $con->close();
                    ?>
                </table>

        <!-- Modal HTML Markup For Applicant Registration Form-->
        <div class="modal fade" id="applicantDetailsForm">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <!--Modal Header-->
                    <div class="modal-header">
                      <div id="formHeader">
                        <h4 class="modal-title text-xs-center">Applicant Registration</h4>
                      </div>

                      <div id="confirmHeader" hidden>
                        <h4 class="modal-title text-xs-center">Succssfully Uploaded</h4>
                      </div>       
                    </div>

                    <form  id="applicant_form" action="registerApplicant.php" method="POST">
                        <input type="text" id="username" name="username" hidden>
                        <input type="text" id="password" name="password" hidden>
                        
                        <!--Modal Body-->
                        <div class="modal-body">
                                <div id="applicant_details">
                                    <!--Organization ID-->
                                    <div class="form-group row">
                                        <div class="col-4">
                                            <label class="control-label">Organization ID</label>
                                        </div>
                                        <div class="col-8">
                                            <input type="text" id="orgID" name="orgID" class="form-control" hidden>
                                            <p id="displayOrgID"></p>
                                        </div>
                                    </div>

                                    <!--Full Name-->
                                    <div class="form-group row">
                                        <div class="col-4">
                                            <label class="control-label">Full Name</label>
                                        </div>
                                        <div class="col-8">
                                            <input type="text" id="name" name="name" class="form-control" placeholder="Please enter your fullname">
                                        </div>
                                    </div>

                                    <!--ID No-->
                                    <div class="form-group row">
                                        <div class="col-4">
                                            <label class="control-label">ID No</label>
                                        </div>
                                        <div class="col-8">  
                                            <input type="text" id="idNo" name="idNo" class="form-control" placeholder="Please enter your ID Number">
                                        </div>
                                    </div>

                                    <!--Address-->
                                    <div class="form-group row">
                                        <div class="col-4">
                                            <label class="control-label">Address</label>
                                        </div>
                                        <div class="col-8">
                                            <input type="text" id="address" name="address" class="form-control" placeholder="Please enter your address">
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
                                </div>
                            
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
                            </div>

                            <!--Confirmation Part-->
                            <div id="confirmBody" hidden>
                              <p>Do you want to upload another document?</p>
                            </div>
                        </div>

                        

                        <!--Modal Footer-->
                        <div class="modal-footer">
                            <!--Button for applicant details-->
                            <div id="applicant_details_btn">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button id="registNext" type="button" class="btn btn-default" onclick="registerNextBtn()">Next</button>
                            </div>

                            <!--Button for upload document-->
                            <div id="document_btn" hidden>
                                <button id="registBack" type="button" class="btn btn-default" onclick='showApplicantDetailsForm()'>Back</button>
                                <button id="checkForm" type="button" class="btn btn-default" onclick='registBtn()'>Submit</button>
                            </div>

                            <!--Button for confitmation-->
                            <div id="confirmFooter" hidden>
                              <button type="button" class="btn btn-default btn-sm" id="addDoc" onclick='submitForm()'>Yes</button>
                              <button type="button" class="btn btn-default btn-sm" id="notAdd" onclick='submitLast()'>No</button>
                            </div>
                        </div>
                    </form>
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
  <script src="assets/js/registerApplicant.js"></script>

  <script>
    const applicantForm = document.getElementById("applicant_form");
  </script>

</body>

</html>
