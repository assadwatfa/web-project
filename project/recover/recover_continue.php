<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Green Leb - Login Page</title>
</head>
<body>
<?php
session_start();
if (isset($_SESSION['email'])) {
    header('location: ../profile/');
} else {
    ?>
    <table>
        <form method="post" action="recover_handler.php">
            <tr>
                <td>E-mail:</td>
                <td><input type="email" name="email" size="30"></td>
            </tr>
            <tr>
                <td>Code:</td>
                <td><input type="text" name="recovery_code" size="30"></td>
            </tr>
            <tr>
                <td>Password:</td>
                <td><input type="password" name="password1" size="30"></td>
            </tr>
            <tr>
                <td>Re-type password:</td>
                <td><input type="password" name="password2" size="30"></td>
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