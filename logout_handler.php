<?php
session_start();
session_destroy();
session_start();
$_SESSION['message'] = 'Successfully logged out';
$_SESSION['message_type'] = "happy";
header("Location: login.php");
exit;