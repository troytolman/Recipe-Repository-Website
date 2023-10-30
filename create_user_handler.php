<?php
session_start();

require_once 'Dao.php';

$email = trim($_POST['email']);
$username = trim($_POST['username']);
$password = trim($_POST['password']);

$dao = new Dao();
$dao->createUser($email, $username, $password);
$_SESSION['authenticated'] = $dao->authenticate($username, $password);

if ($_SESSION['authenticated']) {
   $_SESSION['userID'] = $dao->getUserID($username);
   header('Location: login_loggedin.php');
} else {
   header('Location: login.php');
}
exit;