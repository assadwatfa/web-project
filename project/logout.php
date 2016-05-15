<?php
/**
 * User: lebgh0st
 * Date: 5/12/16
 */

session_start();

if (isset($_SESSION['email'])) {
    session_destroy();
    print "Successfully logged out. <br/>";
    print "Click <a href='./login/'>here</a> to log back in.";
} else {
    print "No session found. <br/>";
    print "Click <a href='./login/'>here</a> to log in.";
}
