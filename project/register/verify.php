<?php
/**
 * User: lebgh0st
 * Date: 5/12/16
 */

session_start();
include('../config.php');

if (isset($_GET['verification_code']) && isset($_GET['email'])) {
    $email = strip_tags($_GET['email']);
    $code = strip_tags($_GET['verification_code']);

    $sql_check = "SELECT * FROM project_unverified_users WHERE verification_code= '$code' AND email = '$email'";

    $result1 = mysqli_query($conn, $sql_check);
    $rowcount1 = mysqli_num_rows($result1);

    if ($rowcount1 > 0) {
        $row = mysqli_fetch_array($result1, MYSQLI_ASSOC);
        $firstname = $row['firstname'];
        $lastname = $row['lastname'];
        $email = $row['email'];
        $password = $row['password'];
        $phone = $row['phone'];
        $address = $row['address'];
        $date_joined = $row['date_joined'];

        $sql_insert = "INSERT INTO project_users (firstname, lastname, email, password, phone, permissions, address, date_joined)
              VALUES ('$firstname', '$lastname', '$email', '$password', '$phone', '3', '$address', '$date_joined')";

        if (mysqli_query($conn, $sql_insert)) {
            $sql_delete = "DELETE FROM project_unverified_users WHERE verification_code= '$code'";
            if (mysqli_query($conn, $sql_delete)) {
                print "Account successfully activated.<br/>";
                print "Click <a href='../login/'>here</a> to log in.<br/>";
            } else {
                print "Something went wrong with deleting data. <br/>";
            }
        } else {
            print "Something went wrong with inserting data. <br/>";
        }

    } else {
        print "Verification code was not found in database. <br/>";
    }
} else {
    print "Please enter a valid verification code & email.<br/>";
}