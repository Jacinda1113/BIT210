<?php

define('LOCALHOST', 'localhost');
define('USERNAME', 'root');
define('PASS', '');
define('DBNAME', 'HELPAID');

$con = new mysqli(LOCALHOST, USERNAME, PASS, DBNAME);

if($con->error) {
    die("Connection failed: ". $con->connect_error);
}

?>