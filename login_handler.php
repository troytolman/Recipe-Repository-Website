<?php
session_start();

require_once 'Dao.php';

$username = trim($_POST['username']);
$password = trim($_POST['password']);
if (empty($username) || empty($password)) {
   $_SESSION['message'] = 'Invalid Username or password';
   $_SESSION['message_type'] = "sad";
   header('Location: login.php'); // Redirect back to the login page or show an error message
   exit;
}
$username = htmlspecialchars($username, ENT_QUOTES, 'UTF-8'); // Sanitize the username

$dao = new Dao();
$_SESSION['authenticated'] = $dao->authenticate($username, $password);

if ($_SESSION['authenticated']) {
   $_SESSION['userID'] = $dao->getUserID($username);
   $_SESSION['message'] = 'Thank you for logging in!';
   $_SESSION['message_type'] = "happy";
   header('Location: login_loggedin.php'); 
} else {
   header('Location: login.php');
}
exit;