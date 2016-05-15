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
    if (!isset($_POST['firstname'])) {
        print "First name is missing. <br/>";
    } else {
        $firstname = strip_tags($_POST['firstname']);
    }

    if (!isset($_POST['lastname'])) {
        print "First name is missing. <br/>";
    } else {
        $lastname = strip_tags($_POST['lastname']);
    }

    if (!isset($_POST['phone'])) {
        print "Phone number is missing. <br/>";
    } else {
        $phone = strip_tags($_POST['phone']);
    }

    if (!isset($_POST['address'])) {
        print "Address is missing. <br/>";
    } else {
        $address = strip_tags($_POST['address']);
    }

    if (!isset($_POST['password1'])) {
        print "Password 1 is missing. <br/>";
    } else {
        $password1 = strip_tags($_POST['password1']);
    }

    if (!isset($_POST['password2'])) {
        print "Password 2 is missing. <br/>";
    } else {
        $password2 = strip_tags($_POST['password2']);
    }

    if (!isset($_POST['email'])) {
        print "E-mail is missing. <br/>";
    } else {
        $email = strip_tags($_POST['email']);
        if (empty($email)) {
            print "E-mail cannot be empty. <br/>";
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            print "Invalid email format. <br/>";
        } else {
        }
    }

    if (isset($_POST['password1']) && isset($_POST['password2'])) {
        if ($password1 != $password2) {
            print "Passwords do not match. <br/>";
        }
    }

    if (isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['password1']) && isset($_POST['password2']) && isset($_POST['phone']) && isset($_POST['address'])) {
        if ($password1 == $password2) {

            $verification_code = md5(uniqid(rand()));
            $encryptedPassword = md5($password1);
            $sql1 = "SELECT * FROM project_unverified_users WHERE email= '$email'";

            $result1 = mysqli_query($conn, $sql1);
            $rowcount1 = mysqli_num_rows($result1);

            $sql2 = "SELECT * FROM project_users WHERE email= '$email'";

            $result2 = mysqli_query($conn, $sql2);
            $rowcount2 = mysqli_num_rows($result2);
            if ($rowcount1 > 0 || $rowcount2 > 0) {
                print "Username or email is taken. <br/>";
            } else {
                $sql = "INSERT INTO project_unverified_users (verification_code, firstname, lastname, email, password, phone, permissions, address) VALUES ('$verification_code', '$firstname', '$lastname', '$email', '$encryptedPassword', '$phone', '3', '$address')";
                mysqli_query($conn, $sql);

                $message = "Welcome to Green Leb " . $firstname . "\r\n";
                $message .= "Go to http://team-hha.com/project/register/verify.php?verification_code=$verification_code&email=$email to activate your account. \r\n";
                mail($email, 'Green Leb - Account Activation', $message);

                print "Successfully registered <br/>";
                print "Please check your e-mail for activation link.<br/>";
                print "Click <a href='../login/'>here</a> to log in.";
            }
        }
    }
}

?>
</body>
</html>



