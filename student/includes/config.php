<?php
//time zone
$projectRoot = $_SERVER['DOCUMENT_ROOT'] . '/marjcapstone';
date_default_timezone_set('Asia/Kolkata');
//database connection
$con=mysqli_connect("localhost","root","","preschooldb");
if(mysqli_connect_errno()){
echo "Connection Fail".mysqli_connect_error();
}

?>
