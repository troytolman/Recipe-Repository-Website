<?php
session_start();

require_once 'Dao.php';

$_SESSION['input'] = $_POST;

$email = trim($_POST['email']);
$username = trim($_POST['username']);
$password = trim($_POST['password']);

if (empty($email) || empty($username) || empty($password)) {
   $_SESSION['message'] = 'Invalid email, username or password';
   $_SESSION['message_type'] = "sad";
   header('Location: create_user.php'); // Redirect back to the registration page or show an error message
   exit;
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
   // Handle the case where the email is not in a valid format
   $_SESSION['message'] = 'Invalid email';
   $_SESSION['message_type'] = "sad";
   header('Location: create_user.php');
   exit;
}

$email = htmlspecialchars($email, ENT_QUOTES, 'UTF-8'); // Sanitize the email
$username = htmlspecialchars($username, ENT_QUOTES, 'UTF-8');

$dao = new Dao();
$dao->createUser($email, $username, $password);
$_SESSION['authenticated'] = $dao->authenticate($username, $password);

if ($_SESSION['authenticated']) {
   $_SESSION['userID'] = $dao->getUserID($username);
   $_SESSION['message'] = 'Thank you for signing up!';
   $_SESSION['message_type'] = "happy";
   header('Location: login_loggedin.php');
} else {
   header('Location: login.php');
}
exit;