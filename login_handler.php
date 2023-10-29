<?php
session_start();

require_once 'Dao.php';

$username = trim($_POST['username']);
$password = trim($_POST['password']);

$dao = new Dao();
$_SESSION['authenticated'] = $dao->authenticate($username, $password);

if ($_SESSION['authenticated']) {
   header('Location: login.php'); // change to logged in version
} else {
   header('Location: login.php');
}
exit;