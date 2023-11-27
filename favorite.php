<?php
  $page = 'fav';
  require("nav.php"); 
?>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="jcarousel/dist/jquery.jcarousel.min.js"></script>
<script src="main.js"></script>

<div class="carousel-wrapper">
<div data-jcarousel="true" data-wrap="circular" class="carousel">
<ul>
<li><img src="images/img1.jpg" width="600" height="400" alt=""></li>
<li><img src="images/img2.jpg" width="600" height="400" alt=""></li>
<li><img src="images/img3.jpg" width="600" height="400" alt=""></li>
<li><img src="images/img4.jpg" width="600" height="400" alt=""></li>
</ul>
</div>
<a data-jcarousel-control="true" data-target="-=1" href="#" class="carousel-control-prev">&lsaquo;</a> 
<a data-jcarousel-control="true" data-target="+=1" href="#" class="carousel-control-next">&rsaquo;</a> 
</div>

<div id="carousel-text"> 
  <h1>Sign up/Log in to Add Favorite Recipies!</h1>
  <button onclick="location.href='login.php'">Sign up/Log in</button>
</div>

<!-- <div id="low">
  <img src="junk.svg" alt="" width="400" height="400" id="junk">
<h1 class="lowclass">Sign up to save Favorites!</h1>
<p class="lowclass">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy.</p>
<a href="login.php"> <button id="explorebutton">Sign up/Log in</button></a>
</div> -->
</div>




<?php include_once("footer.html"); ?>
