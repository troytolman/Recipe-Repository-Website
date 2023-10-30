<?php
  session_start();

  if(!isset($_SESSION['authenticated'])) {
    header('Location: login.php');
    exit; 
  }

  if(isset($_SESSION['authenticated']) && !$_SESSION['authenticated']) {
    header('Location: login.php');
    exit; 
  }

  $page = 'login';
  require("nav_loggedin.php"); 

  echo "<pre>" . $_SESSION['userID'] . "</pre>";
?>

<div id="signin">
  <h1>Thank you for signing in!</h1>
</div>








<?php include_once("footer.html"); ?>