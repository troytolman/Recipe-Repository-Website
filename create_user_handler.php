<?php
session_start();

require_once 'Dao.php';

$_SESSION['input'] = $_POST;

$email = trim($_POST['email']);
$username = trim($_POST['username']);
$password = trim($_POST['password']);

if (empty($email) && empty($username) && empty($password)) {
   $_SESSION['message'] = 'Invalid email, username and password';
   $_SESSION['message_type'] = "sad";
   header('Location: create_user.php'); // Redirect back to the registration page or show an error message
   exit;
}
else if (empty($email) && empty($username)) {
   $_SESSION['message'] = 'Invalid email and username';
   $_SESSION['message_type'] = "sad";
   header('Location: create_user.php'); // Redirect back to the registration page or show an error message
   exit;
}
else if (empty($email) && empty($password)) {
   $_SESSION['message'] = 'Invalid email and password';
   $_SESSION['message_type'] = "sad";
   header('Location: create_user.php'); // Redirect back to the registration page or show an error message
   exit;
}
else if (empty($username) && empty($password)) {
   $_SESSION['message'] = 'Invalid username and password';
   $_SESSION['message_type'] = "sad";
   header('Location: create_user.php'); // Redirect back to the registration page or show an error message
   exit;
}
else if (empty($username)) {
   $_SESSION['message'] = 'Invalid username';
   $_SESSION['message_type'] = "sad";
   header('Location: create_user.php'); // Redirect back to the registration page or show an error message
   exit;
}
else if (empty($password)) {
   $_SESSION['message'] = 'Invalid password';
   $_SESSION['message_type'] = "sad";
   header('Location: create_user.php'); // Redirect back to the registration page or show an error message
   exit;
}
else if (empty($email)) {
   $_SESSION['message'] = 'Invalid email';
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
$user = $dao->createUser($email, $username, $password);

if ($user === false) {
   $_SESSION['message'] = 'Invalid username';
   $_SESSION['message_type'] = "sad";
   header('Location: create_user.php');
}

$_SESSION['authenticated'] = $dao->authenticate($username, $password);

if ($_SESSION['authenticated']) {
   $_SESSION['userID'] = $dao->getUserID($username);
   $_SESSION['message'] = 'Thank you for signing up!';
   $_SESSION['message_type'] = "happy";
   header('Location: login_loggedin.php');
} else {
   $_SESSION['message'] = 'Invalid username';
   $_SESSION['message_type'] = "sad";
   header('Location: create_user.php');
}
exit;