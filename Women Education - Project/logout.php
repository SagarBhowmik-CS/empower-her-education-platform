<?php
session_start();
session_destroy();
header("Location: Registration.html"); // Redirect to login page
exit();
?>
