
<head>
  <link rel="stylesheet" href="style.css">
  <title>Boise Chef</title>
  <link rel="icon" type="image/x-icon" href="favicon-32x32.png">
</head>

  <div id="navdiv">
<img src="logo.jpg" alt="" width="80" height="80">
<h1 id="logo">Boise Chef</h1>
<div class="topnav">
  <a class=<?php echo ($page == 'index') ? 'active' : "wait"; ?> href='index.php'>Home</a>
  <a class=<?php echo ($page == 'pop') ? 'active' : "wait"; ?> href="popular.php">Popular</a>
  <a class=<?php echo ($page == 'up') ? 'active' : "wait"; ?> href="upload.php">Upload</a>
  <a href="favorite.html">Favorites</a>
  <a href="explore.html">Explore</a>
  <a href="login.html">Log in/Sign up</a>
</div>
<hr>