<?php
$connection = new mysqli ("localhost", "root", "", "helpaid",3307);

if ($connection -> connect_error){
    die($connection -> connect_error);
}else{
    #echo '<script type="text/javascript">';
    echo 'alert("Connection success.")';
    #echo '</script>';
}

$sqlQuery = "insert into * from orgRep where username='$user_name' AND full'$full"
?>