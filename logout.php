<?php
session_start();

// Logout by destroying the session
session_destroy();

// Redirect to the login page
header('Location: login.php');
exit();

?>
