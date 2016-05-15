<?php

$dbhost = "localhost:3306";
$dbusername = "hassan";
$dbpassword = "hassan123";
$dbname = "project";
$conn = mysqli_connect($dbhost, $dbusername, $dbpassword);
if ($conn) {
    mysqli_select_db($conn, $dbname);
} else {
    print "Cannot connect to database.";
}

?>

