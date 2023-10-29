
<head>
  <link rel="stylesheet" href="style.css">
  <title>Boise Chef</title>
  <link rel="icon" type="image/x-icon" href="favicon-32x32.png">
</head>

  <div id="navdiv">
<img src="logo.jpg" alt="" width="80" height="80">
<h1 id="logo">Boise Chef</h1>
<div class="topnav">
  <a class=<?php echo ($page == 'index') ? 'active' : "wait"; ?> href='index_loggedin.php'>Home</a>
  <a class=<?php echo ($page == 'pop') ? 'active' : "wait"; ?> href="popular_loggedin.php">Popular</a>
  <a class=<?php echo ($page == 'up') ? 'active' : "wait"; ?> href="upload_loggedin.php">Upload</a>
  <a class=<?php echo ($page == 'fav') ? 'active' : "wait"; ?> href="favorite_loggedin.php">Favorites</a>
  <a class=<?php echo ($page == 'exp') ? 'active' : "wait"; ?> href="explore_loggedin.php">Explore</a>
  <a class=<?php echo ($page == 'login') ? 'active' : "wait"; ?> href="logout_handler.php">Log Out</a>
</div>
<hr>