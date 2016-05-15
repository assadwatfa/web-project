<style>
    img {
        border-radius: 80mm;
    }
</style>


<?php
/**
 * User: lebgh0st
 * Date: 5/12/16
 */
session_start();

include('../config.php');
include('../nodes/index.php');
function displayInformation($email)
{

    global $conn;
    $sql = "SELECT * FROM project_users WHERE email= '$email'";

    $result = mysqli_query($conn, $sql);
    $rowcount = mysqli_num_rows($result);

    if ($rowcount > 0) {
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        print "<img src='" . get_gravatar($_SESSION['email']) . "'/><br/>";
        print "First name: " . $row['firstname'] . " <br/>";
        print "Last name: " . $row['lastname'] . " <br/>";
        print "E-mail: " . $row['email'] . " <br/>";
        print "Phone number: " . $row['phone'] . " <br/>";
        print "Address: " . $row['address'] . " <br/>";
        print "Date joined: " . $row['date_joined'] . " <br/>";
    }
}

/**
 * Get either a Gravatar URL or complete image tag for a specified email address.
 *
 * @param string $email The email address
 * @param string $s Size in pixels, defaults to 80px [ 1 - 2048 ]
 * @param string $d Default imageset to use [ 404 | mm | identicon | monsterid | wavatar ]
 * @param string $r Maximum rating (inclusive) [ g | pg | r | x ]
 * @param boole $img True to return a complete IMG tag False for just the URL
 * @param array $atts Optional, additional key/value attributes to include in the IMG tag
 * @return String containing either just a URL or a complete image tag
 * @source http://gravatar.com/site/implement/images/php/
 */
function get_gravatar($email, $s = 80, $d = 'mm', $r = 'g', $img = false, $atts = array())
{
    $url = 'http://www.gravatar.com/avatar/';
    $url .= md5(strtolower(trim($email)));
    $url .= "?s=$s&d=$d&r=$r";
    if ($img) {
        $url = '<img src="' . $url . '"';
        foreach ($atts as $key => $val)
            $url .= ' ' . $key . '="' . $val . '"';
        $url .= ' />';
    }
    return $url;
}

if (isset($_SESSION['email'])) {
    displayInformation($_SESSION['email']);
    print "Click <a href='../logout.php'>here</a> to logout. <br/>";
    print "Click <a href='./change_password.php'>here</a> to change password.";
    print getPermissions($_SESSION['email']);

} else {
    header('location: ../login/');
}
