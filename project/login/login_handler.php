<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Form</title>
</head>
<body>
<?php
session_start();
include('../config.php');


if (isset($_SESSION['email'])) {
    header('location: ../profile/');
} else {
    if (!isset($_POST['email'])) {
        print "E-mail is missing.";
    } else {
        $email = strip_tags($_POST['email']);
    }

    if (!isset($_POST['password'])) {
        print "Password is missing.";
    } else {
        $password = strip_tags($_POST['password']);
    }

    if (isset($_POST['email']) && isset($_POST['password'])) {

        $encryptedPassword = md5($password);
        $sql = "SELECT * FROM project_users WHERE email= '$email' AND password= '$encryptedPassword'";

        $result = mysqli_query($conn, $sql);
        $rowcount = mysqli_num_rows($result);
        if ($rowcount > 0) {
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            session_start();
            $_SESSION['email'] = $row['email'];
            $_SESSION['firstname'] = $row['firstname'];
//            print "Welcome back " . $_SESSION['firstname'] . "!";
            header('location: ../profile/');
        } else {
            print "Wrong email or password.";
        }
    }
}


?>
</body>
</html>



