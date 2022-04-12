<?php
session_start()
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Record Contribution</title>
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
              <li><a class="nav-link scrollto active" href="recordContribution.php">Record Contribution</a></li>
              <li><a class="nav-link scrollto" href="registerApplicantByOrgRep.php">Applicant Registration</a></li>
              <li><a class="nav-link scrollto" href="aidAppeal.php">Record New Appeal</a></li>
              <li><a class="nav-link scrollto" href="aidDisbursement.php">Record Aid Disbursement</a></li>
              <li><a class="nav-link scrollto" href="AidDelivered.php">Package Status</a></li>
              <li><a class="nav-link scrollto" href="logout.php">Logout</a></li>
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
            <h2>Choose Appeal</h2>
            <ol>
              <li><a href="orgRepDashboard.php">Home</a></li>
              <li>Record Contribution</li>
            </ol>
          </div>
        </div>
      </section><!-- End Breadcrumbs -->

      <section class="inner-page">
        <div class="container">
            <div class="row">
                <?php
                  require("dbConnection.php");

                  //count number of contribution]
                  $contriQuery = "SELECT * FROM Contribution";
                  $allContributions = $con -> query($contriQuery);
                  $contributions = $allContributions->fetch_all(MYSQLI_ASSOC);
                  echo "<script>var countContribution = ".count($contributions)."</script>";
                ?>
                <!--Appeal List Table-->
                <table class="table table-striped table-bordered text-center">
                    <tr>
                        <th>Appeal ID</th>
                        <th>Description</th>
                        <th></th>
                    </tr>

                    <?php
                        $appealQuery = "SELECT * FROM Appeal WHERE orgID = {$_SESSION['OrgID']}";
                        $appeal = $con->query($appealQuery);

                        if($appeal){
                            if($appeal->num_rows == 0){
                                echo'<tr><td colspan = "3">No Appeal to Select </td></tr>';
                            }
                            else{
                                while($row = $appeal -> fetch_assoc()){
                                    echo"<tr>
                                            <td>{$row['appealID']}</td>
                                            <td>{$row['description']}</td>
                                            <td>
                                                <button class='btn btn-default btn-sm' id='{$row['appealID']}' type='button' onclick='getAppealID(\"{$row['appealID']}\", \"{$row['fromDate']}\", \"{$row['toDate']}\")' data-toggle='modal' data-target='#recContributionForm'>
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

                <!-- Modal HTML Markup For Record Contribution Form-->
                <div class="modal fade" id="recContributionForm">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title text-xs-center">Record Contribution</h4>
                            </div>
                            <div class="modal-body">
                                <form id="recordContribution" method="POST" onsubmit="submitContribution();" action="recordContributionProc.php">
                                    <!--Contribution ID-->
                                    <input type="text" id="contributionID" name="contributionID" hidden>  
                            
                                    <!--Appeal ID-->
                                    <div class="form-group row">
                                        <div class="col-4">
                                            <label class="control-label">Appeal ID</label>
                                        </div>
                                        <div class="col-8">
                                            <input type="text" class="form-control" id="appealID" name="appealID" hidden>
                                            <p id="displayAppealID"></p>
                                        </div>
                                    </div>

                                    <!--Start Date-->
                                    <div class="form-group row">
                                        <div class="col-4">
                                            <label class="control-label">Start Date</label>
                                        </div>
                                        <div class="col-8">
                                            <p id="displayStartDate"></p>
                                        </div>
                                    </div>

                                    <!--End Date-->
                                    <div class="form-group row">
                                        <div class="col-4">
                                            <label class="control-label">End Date</label>
                                        </div>
                                        <div class="col-8">
                                            <p id="displayEndDate"></p>
                                        </div>
                                    </div>

                                    <!--Donation Type-->
                                    <div class="form-group row">
                                        <div class="col-4">
                                        <label class="control-label" for="donationType">Donation Type</label>
                                        </div>
                                        <div class="col-8">  
                                        <select class="form-select" id="donationType" name="donationType">
                                            <option value="CASH" selected>Cash Donation</option>
                                            <option value="GOODS">Goods Donation</option>
                                        </select>
                                        </div>
                                    </div>

                                <!--Cash Donation Form-->
                                <div id="cashForm">
                                    <!--Total Amount-->
                                    <div class="form-group row">
                                        <div class="col-4">
                                            <label class="control-label">Total Amount</label>
                                        </div>
                                        <div class="col-8">
                                            <div class="input-group">
                                                <span class="input-group-text" id="basic-addon1">RM</span>
                                                <input type="number" class="form-control" id="amount" name="amount" aria-label="Amount" aria-describedby="basic-addon1" placeholder="450.50">
                                            </div>
                                        </div>
                                    </div>

                                    <!--Payment Channel-->
                                    <div class="form-group row">
                                        <div class="col-4">
                                        <label class="control-label">Payment Channel</label>
                                        </div>
                                        <div class="col-8">  
                                        <select class="form-select" id="paymentMethod" name="paymentMethod">
                                            <option value="-1" selected>Choose Payment Method</option>
                                            <option value="Online Banking">Online Banking</option>
                                            <option value="E-Wallet">E-Wallet</option>
                                            <option value="Bank Transfer">Bank Transfer</option>
                                            <option value="Credit Card">Credit Card</option>
                                        </select>
                                        </div>
                                    </div>

                                    <!--Reference Number-->
                                    <div class="form-group row">
                                        <div class="col-4">
                                        <label class="control-label">Reference No</label>
                                        </div>
                                        <div class="col-8">
                                        <input type="text" id="referenceNo" name="referenceNo" value="" class="form-control" placeholder="Please input your payment reference number">
                                        </div>
                                    </div>
                                </div>
                                
                                <!--Goods Donation Form-->
                                <div id="goodsForm" hidden>
                                    <!--Goods Description-->
                                    <div class="form-group row">
                                        <div class="col-4">
                                            <label class="control-label" for="description">Description</label>
                                        </div>
                                        <div class="col-8">
                                            <input type="text" id="description" name="goodDesc" class="form-control">
                                        </div>
                                    </div>

                                    <!--Estimated Value-->
                                    <div class="form-group row">
                                        <div class="col-4">
                                            <label class="control-label" for="estValue">Estimated Value</label>
                                        </div>
                                        <div class="col-8">
                                            <div class="input-group">
                                                <span class="input-group-text" id="basic-addon1">RM</span>
                                                <input type="number" class="form-control" id="estValue" name="estValue" aria-label="Amount" aria-describedby="basic-addon1" placeholder="450.50">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <!--Submit Button-->
                                <div class="form-group button">
                                    <button hidden type="button" id="hideModal" data-toggle="modal" data-target="#donationComplete" data-dismiss="modal"></button>
                                    <input type="submit" class="btn btn-default float-end">
                                </div>
                            </form>
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
    <script src="assets/js/recordContribution.js"></script>

  <script>
    const recordContribution = document.getElementById("recordContribution");
  </script>

</body>

</html>
