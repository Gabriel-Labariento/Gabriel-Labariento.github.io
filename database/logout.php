<?php
//start session
session_start();

//remove all session variables
session_unset();

//destroy
session_destroy();

//redirect
header('location: ../login.php')

?>