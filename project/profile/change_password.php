<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Green Leb - Login Page</title>
</head>
<body>
<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('location: ../login/');
} else {
    ?>
    <table>
        <form method="post" action="change_password_handler.php">
            <tr>
                <td>Current Password:</td>
                <td><input type="password" name="currentpassword" placeholder="Enter your current password" size="30">
                </td>
            </tr>
            <tr>
                <td>New Password:</td>
                <td><input type="password" name="password1" placeholder="Enter your new password" size="30"></td>
            </tr>
            <tr>
                <td>Re-type new password:</td>
                <td><input type="password" name="password2" placeholder="Confirm your new password" size="30"></td>
            </tr>
            <tr>
                <td><input type="submit" value="Save"></td>
            </tr>
        </form>
    </table>
    <?php
}
?>

</body>
</html>