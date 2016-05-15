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


if (!isset($_SESSION['email'])) {
    header('location: ../login/');
} else {
    if (!isset($_POST['currentpassword'])) {
        print "Recovery code is missing.";
    } else if (!isset($_POST['password1']) || !isset($_POST['password2'])) {
        print "Passwords missing.";
    } else if (isset($_POST['currentpassword']) && isset($_POST['password1']) && isset($_POST['password2'])) {
        if ($_POST['password1'] === $_POST['password2']) {
            $email = $_SESSION['email'];

            $currentpassword = strip_tags($_POST['currentpassword']);
            $password = strip_tags($_POST['password1']);

            $encryptedCurrentPassword = md5($currentpassword);
            $encryptedNewPassword = md5($password);


            $sql_check = "SELECT * FROM project_users WHERE password= '$encryptedCurrentPassword' AND email= '$email'";

            $result_check = mysqli_query($conn, $sql_check);
            $rowcount = mysqli_num_rows($result_check);
            $row = mysqli_fetch_array($result_check, MYSQLI_ASSOC);
            $email = $row['email'];

            if ($rowcount > 0) {
                $sql_update_password = "UPDATE project_users SET password='$encryptedNewPassword' WHERE email= '$email'";
                if (mysqli_query($conn, $sql_update_password)) {
                    session_destroy();
                    print "Successfully changed password. <br/>";
                    print "Please login back in by clicking <a href='../login/'>here</a>.";
                }
            } else {
                print "Wrong password.";
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



