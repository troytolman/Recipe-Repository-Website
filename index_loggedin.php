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

  $page = 'index';
  require("nav_loggedin.php"); 
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
  <h1>Explore Recipies Now!</h1>
  <button onclick="location.href='explore.php'">Explore</button>
</div>

</div>

<!-- <div id="explore"> 
  Explore Boise Chef Now!!!
</div>

<div id="search">
  <input type="text" placeholder="Search..">
<form id="searchform">
  <label for="breakfast"><input type="checkbox" id="breakfast" name="items" value="breakfast"> breakfast</label><br>
  <label for="lunch"><input type="checkbox" id="lunch" name="items" value="lunch"> lunch</label><br>
  <label for="dinner"><input type="checkbox" id="dinner" name="items" value="dinner"> dinner</label><br>
  <label for="dessert"><input type="checkbox" id="dessert" name="items" value="dessert"> dessert</label><br>
  <label for="beginner"><input type="checkbox" id="beginner" name="items" value="beginner"> beginner</label><br>
  <label for="intermediate"><input type="checkbox" id="intermediate" name="items" value="intermediate"> intermediate</label><br>
  <label for="expert"><input type="checkbox" id="expert" name="items" value="expert"> expert</label><br>
</form>
</div> -->


<?php include_once("footer.html"); ?>

