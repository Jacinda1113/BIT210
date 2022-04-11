<?php
$connection = new mysqli ("localhost", "root", "", "helpaid",3308);

if ($connection -> connect_error){
    die($connection -> connect_error);
}else{
    #echo '<script type="text/javascript">';
    #echo 'alert("Connection success.")';
    #echo '</script>';
}
?>