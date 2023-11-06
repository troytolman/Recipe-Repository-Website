<?php
  session_start();
  $page = 'login';
  require("nav.php"); 
?>

<div id="signin">
  <h1>Create an account</h1>
  <form action="create_user_handler.php" method="post">
  <?php
   
   if(isset($_SESSION['message'])) {
      echo "<div id='content'>";
      echo "<div class='" . $_SESSION['message_type'] . "' id='message'>" . $_SESSION['message'] . "</div>";
      unset($_SESSION['message']);
      unset($_SESSION['message_type']);
   }
   ?>
    <label><input type="text" id="email" name="email" value="<?php echo isset($_SESSION['input']['email']) ? $_SESSION['input']['email'] : '' ?>">Email</label><br>
    <label><input type="text" id="username" name="username" value="<?php echo isset($_SESSION['input']['username']) ? $_SESSION['input']['username'] : '' ?>">Username</label><br>
    <label><input type="password" id="password" name="password" value="<?php echo isset($_SESSION['input']['password']) ? $_SESSION['input']['password'] : '' ?>">Password</label><br>
    <label><input type="submit" id="continue" name="login"></label><br>
    <?php unset($_SESSION['input']); ?>
</div>
</div>




<?php include_once("footer.html"); ?>

