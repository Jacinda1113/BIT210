<?php
    session_start();

    require('dbConnection.php');

    if(isset($_POST["username"], $_POST["password"])){
        $username = $_POST["username"];
        $password = $_POST["password"];

        //check if the user is admin
        if($username == "Admin" && $password == "Admin123"){
            header("location: admin.php");
        }
        else{
            $sql = "select * from User WHERE (username = '$username' AND password = '$password')";
            $result = $con -> query($sql);
            
            //fetch result
            $loginUser = $result -> fetch_assoc();

            if(is_null($loginUser)){
                echo "Username/password does not match";
            }
            else{
                $_SESSION["username"] = $loginUser["username"];
                $_SESSION["fullname"] = $loginUser["fullname"];
                $orgID = $loginUser["OrgID"];
                //check if the user is applicant
                if ($loginUser["userType"] == "APPLICANT"){
                    header("location: applicantDashboard.php");
                }
                //else user is organization representative
                else{
                    $orgSQL = "SELECT * FROM Organization WHERE OrgID = '$orgID'";
                    $orgResult = $con -> query($orgSQL);

                    //fetch result
                    $org = $orgResult -> fetch_assoc();
                    $_SESSION["OrgName"] = $org["OrgName"];
                    $_SESSION["OrgID"] = $org["OrgID"];
                    $_SESSION["OrgAddress"] = $org["OrgAddress"];
                    header("location: orgRepDashboard.php");
                }
            }
        } 
    }
    $con->close();

?>