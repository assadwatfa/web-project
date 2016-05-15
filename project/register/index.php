<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Form</title>
</head>
<body>
<?php
session_start();

if (isset($_SESSION['email'])) {
    header('location: ../profile/');
} else {
    ?>
    <table>
        <form method="post" action="register_handler.php">
            <tr>
                <td>First name:</td>
                <td><input type="text" name="firstname" size="30"></td>
            </tr>
            <tr>
                <td>Last name:</td>
                <td><input type="text" name="lastname" size="30"></td>
            </tr>
            <tr>
                <td>E-mail:</td>
                <td><input type="email" name="email" size="30"></td>
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
                <td>Phone number:</td>
                <td><input type="text" name="phone" size="30"></td>
            </tr>
            <tr>
                <td>Address:</td>
                <td><input type="text" name="address" size="30"></td>
            </tr>

            <tr>
                <td><input type="submit" value="Register"></td>
            </tr>
        </form>
    </table>

    <?php
}
?>
</body>
</html>



