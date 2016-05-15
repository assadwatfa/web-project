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
    if (!isset($_POST['recovery_code'])) {
        print "Recovery code is missing.";
    } else if (!isset($_POST['email'])) {
        print "Email is missing.";
    } else if (!isset($_POST['password1']) || !isset($_POST['password2'])) {
        print "Passwords missing.";
    } else if (isset($_POST['recovery_code']) && isset($_POST['password1']) && isset($_POST['password2']) && isset($_POST['email'])) {
        if ($_POST['password1'] === $_POST['password2']) {
            $email = strip_tags($_POST['email']);
            $code = strip_tags($_POST['recovery_code']);
            $password = strip_tags($_POST['password1']);
            $encryptedPassword = md5($password);


            $sql_check = "SELECT * FROM project_users WHERE password_recovery= '$code' AND email= '$email'";

            $result_check = mysqli_query($conn, $sql_check);
            $rowcount = mysqli_num_rows($result_check);
            $row = mysqli_fetch_array($result_check, MYSQLI_ASSOC);
            $email = $row['email'];

            if ($rowcount > 0) {
                $sql_update_password = "UPDATE project_users SET password='$encryptedPassword' WHERE password_recovery= '$code'";
                if (mysqli_query($conn, $sql_update_password)) {
                    $sql_update_recovery = "UPDATE project_users SET password_recovery='' WHERE email= '$email'";
                    if (mysqli_query($conn, $sql_update_recovery)) {
                        print "Successfully changed password. <br/>";
                        print "Click <a href='../login/'>here</a> to log in.";
                    }
                }
            } else {
                print "Recovery code not found.";
            }
        } else {
            print "Passwords do not match.";
        }
    } else {
        print "Something went wrong.";

    }
}
?>
</body>
</html>



