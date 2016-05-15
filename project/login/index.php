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
        <form method="post" action="login_handler.php">
            <tr>
                <td>E-mail:</td>
                <td><input type="text" name="email" size="30"></td>
            </tr>
            <tr>
                <td>Password:</td>
                <td><input type="password" name="password" size="30"></td>
            </tr>
            <tr>
                <td><input type="submit" value="Login"></td>
            </tr>
            <tr>
                <td><a href="../register/">New user? Register</a></td>
            </tr>
        </form>
    </table>
    <?php
}
?>

</body>
</html>



