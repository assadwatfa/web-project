<?php
/**
 * Created by PhpStorm.
 * User: Hassan
 * Date: 5/14/2016
 * Time: 5:34 PM
 */

include('../config.php');

function getPermissions($email)
{

    global $conn;
    $sql = "SELECT * FROM project_users WHERE email= '$email'";

    $result = mysqli_query($conn, $sql);
    $rowcount = mysqli_num_rows($result);

    if ($rowcount > 0) {
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $permissions = $row['permissions'];

        if ($permissions == 1) {
            return 1;
        } else if ($permissions == 2) {
            return 2;
        } else if ($permissions == 3) {
            return 3;
        } else {
            return -1;
        }
    } else {
        print $email . " was not found.";
    }
}