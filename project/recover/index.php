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
    <form action="recover_process.php" method="post">
        <table>
            <tr>
                <td>Enter your E-mail:</td>
                <td><input type="email" size="30" name="email"></td>
            </tr>
            <tr>
                <td><input type="submit" value="Recover"></td>
            </tr>
        </table>
    </form>

    <?php
}
?>
</body>
</html>



