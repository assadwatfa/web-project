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
        print "Recovery code is missing.";
    } else {
        $email = strip_tags($_POST['email']);
        $code = md5(uniqid(rand()));
        $sql1 = "UPDATE project_users SET password_recovery='$code' WHERE email= '$email'";

        if (mysqli_query($conn, $sql1)) {
            print "Successfully generated a recovery code. <br/>";
            print "Click <a href='./recover_continue.php'>here</a> to process recovering your account. <br/>";

            $message = "Your recovery code is " . $code . "\r\n";
            $message .= "Go to http://team-hha.com/project/recover_continue.php to process your password changes.\r\n";
            mail($email, 'Green Leb - Password Recovery', $message);

        }
    }
}

?>
</body>
</html>



