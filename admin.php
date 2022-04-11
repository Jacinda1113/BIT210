<?php
$username = $fullname= $email = $mobileno = $jobtitle="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = test_input($_POST["username"]);
  $fullname = test_input($_POST["fullname"]);
  $email = test_input($_POST["email"]);
  $mobileno = test_input($_POST["mobileno"]);
  $jobtitle = test_input($_POST["jobtitle"]);
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
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
            <h1 class="text-light"><a href="index.html"><span>HELP Aid</span></a></h1>
          </div>
  
          <nav id="navbar" class="navbar">
            <ul>
              <li><a class="nav-link scrollto" href="registerForOrg.html">Organization Registration</a></li>
              <li><a class="nav-link scrollto " href="admin.html">Representative Registration</a></li>
              <li><a class="nav-link scrollto" href="logout.php">Logout</a></li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
          </nav><!-- .navbar -->

        </div>
        
    </header><!-- End Header -->

    <main id="main">
       <!-- Modal HTML Markup For Organisation Representative Form-->
       <form id="orgRepForm" method="POST" action= >
        <div class="modal fade" id="orgRep">
        <div class="modal-dialog modal-dialog-centered">
          <input type="hidden" name="_token" value="">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-xs-center">Orgnization Representative</h4>
                </div>
                <div class="form-area modal-body">
                      <div class="form-group row">
                        <div>
                          <label class="col-12" id="displayOrgID"></label>
                        </div>
                        <div class="col-12">
                          <label for="username" class="control-label">User Name: </label>
                        </div>
                        <div class="col-12">
                            <input type="text" class="form-control" value=""  id="username" name="username" placeholder="User Name"> 
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-12">
                          <label for="fullname" class="control-label">Full name: </label>
                        </div>
                        <div class="col-12">
                            <input type="text" class="form-control" value="" id="fullname" name="fullname"  placeholder="Full Name">
                        </div>

                      </div>
                        <div class="form-group row">
                          <div class="col-12">
                            <label for="username" class="control-label">Email: </label>
                          </div>
                          <div class="col-12">  
                            <input type="email" value="" class="form-control" name="email" id="email" placeholder="Your Email">
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-12">
                            <label for="mobile" class="control-label">Mobile number: </label>
                          </div>
                          <div class="col-12">
                            <input class="form-control" value="" id="mobile" name="mobile" type="tel" placeholder="+6012 1212 3458">
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-12">
                            <label for="jobTitle" class="control-label">Job Title:</label>
                          </div>
                            <div class="col-12">
                                <input class="form-control" value="" id="jobTitle" name="jobTitle" type="text" placeholder="Job Title">
                            </div>
                        </div>
                        <div class="form-group button">
                          <button hidden type="button" id="testing" data-toggle="modal" data-target="#registerDone" data-dismiss="modal">
                          </button>
                          <input type="submit" value="Submit" id="registerOrgRep" class="btn btn-default float-end">
                        </div>
                      </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
              </div><!-- /.modal -->
            </form>           
                          
            <!--Modal For Successfull Registration of Organization Representative-->
            <div class="modal fade" id="registerDone">
              <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h4 class="modal-title text-xs-center">Thank you</h4>
                      </div>
                      <div class="modal-body">
                          <p>Organisation Representative Has Been Registered Successfully!</p>
                      </div>
                      <div class="modal-footer">
                        <button class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                      </div>
                  </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->

            <!--Choose organization ID-->
            <div class="container">
              <div class="row">
                    <div class="text-center">
                      <h3 class="fw-bold mt-3">Welcome, Admin!</h3>
                      <label for="orgID"> Organization ID:</label>
                      <select id="orgID" class="form-select row" name="orgID">
                        <option value="-1" selected>Select an organization ID</option>
                          <option value="HA001">HA001</option>
                          <option value="HA002">HA002</option>
                          <option value="HA003">HA003</option>
                          <option value="HA004">HA004</option>
                          <option value="HA005">HA005</option>
                          <option value="HA006">HA006</option>
                          <option value="HA007">HA007</option>
                          <option value="HA008">HA008</option>
                          <option value="HA009">HA009</option>
                          <option value="HA010">HA010</option>
                      </select>
                      <button class="btn btn-sm btn-default" id="selectOrg" onclick="displaySelectedID();" data-toggle="modal" data-target="#orgRep">Confirm</button>
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

<!-- Bootstrap javascript -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<!-- Vendor JS Files -->
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Template Main JS File -->
<script src="assets/js/main.js"></script>
  
<!--Display Organization ID-->
<script>
  //function to get selected org ID
  function displaySelectedID()
  {
    //get button element using ID
    var selectOrg = document.getElementById('selectOrg');
    //get datalist element using id
    var getValue = document.getElementById('orgID');
    document.getElementById("displayOrgID").innerHTML = "Selected Organization ID: " + getValue.options[getValue.selectedIndex].value;
  }
</script>
    <!--Form Validation -->
    <script>
      //add event handler for organisation representative form
      var orgRepForm = document.getElementById("orgRepForm");
  
      orgRepForm.addEventListener("submit", (e) => {
        e.preventDefault();
        if(validateOrgForm() == true)
        orgRepForm.reset();
      });
      
      //function to validate organization representative form
      function validateOrgForm(){
        const username = orgRepForm.username.value;
        const fullname = orgRepForm.fullname.value;
        const email = orgRepForm.email.value;
        const phone = orgRepForm.mobile.value;
        const jobValue = orgRepForm.jobTitle.value;
  
        if(username == ""){
          alert("Please fill in the username!");
          orgRepForm.username.focus();
          return false;
        }
        else if(username.length < 8){
          alert("Username should at least have 8 characters");
          orgRepForm.username.focus();
          return false;
        }
        else if(fullname == ""){
          alert("Please fill in the full name!");
          orgRepForm.fullname.focus();
          return false;
        }
        else if(email == ""){
          alert("Please fill in the email address!");
          orgRepForm.email.focus();
          return false;
        }
        else if(isEmail(email) == false){
          alert("Invalid email!");
          return false;
        }
        else if(phone == ""){
          alert("Please fill in the phone number");
          orgRepForm.mobile.focus();
          return false;
        }
        else if(!/^\+?([0-9]{4})\)?[-. ]?([0-9]{4})[-. ]?([0-9]{4})$/.test(phone)){
          alert("Invalid phone number!");
          orgRepForm.mobile.focus();
          return false;
        }
        else if(jobValue == ""){
          alert("Pelase fill in the Job title");
          orgRepForm.jobTitle.focus();
          return false;
        }
        else{
          document.getElementById("testing").click();
          return true;
        }
      }
  
      //function to check email format
      function isEmail(email) {
      return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);
      }
   </script>

</body>

</html>
