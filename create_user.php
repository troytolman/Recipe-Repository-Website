<?php
  $page = 'login';
  require("nav.php"); 
?>

<div id="signin">
  <h1>Create an account</h1>
  <form action="create_user_handler.php" method="post">
    <label><input type="text" id="email" name="email">Email</label><br>
    <label><input type="text" id="username" name="username">Username</label><br>
    <label><input type="password" id="password" name="password">Password</label><br>
    <label><input type="submit" id="continue" name="login" ></label><br>
</div>
</div>




<?php include_once("footer.html"); ?>

