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
  if(isset($_SESSION['message'])) {
    echo "<div id='content'>";
    echo "<div class='" . $_SESSION['message_type'] . "' id='message'>" . $_SESSION['message'] . "</div>";
    unset($_SESSION['message']);
    unset($_SESSION['message_type']);
 }
?>

<div id="signin">
  <h1>Thank you for signing in!</h1>
</div>








<?php include_once("footer.html"); ?>