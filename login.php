<?php
  session_start();

  if(isset($_SESSION['authenticated']) && $_SESSION['authenticated']) {
    header('Location: login_loggedin.php');
    exit; 
  }

  $page = 'login';
  require("nav.php"); 
?>

<div id="signin">
  <h1>Sign in or create an account</h1>
  <h4><a href="create_user.php">Create new account</a></h4>
  <form action="login_handler.php" method="post">
  
   <?php
   
   if(isset($_SESSION['message'])) {
      echo "<div id='content'>";
      echo "<div class='" . $_SESSION['message_type'] . "' id='message'>" . $_SESSION['message'] . "</div>";
      unset($_SESSION['message']);
      unset($_SESSION['message_type']);
   }
   ?>
    <label><input type="text" id="username" name="username">Username</label><br>
    <label><input type="password" id="password" name="password">Password</label><br>
    <label><input type="submit" id="continue" name="login" ></label><br>
  </form> 
</div>







<?php include_once("footer.html"); ?>

