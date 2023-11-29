<?php
  $page = 'up';
  require("nav.php"); 
  require("Dao.php");
?>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="jcarousel/dist/jquery.jcarousel.min.js"></script>
<script src="main.js"></script>

<div class="carousel-wrapper">
<div data-jcarousel="true" data-wrap="circular" class="carousel">
<ul>
<?php
    $dao = new Dao();
    $recipes = $dao->getRecipeImages();
    foreach ($recipes as $recipe) {
      echo '<li><img src="' . $recipe['image_url'] . '" width="600" height="400" alt=""></li>"';
    }
 ?> 
</ul>
</div>
<a data-jcarousel-control="true" data-target="-=1" href="#" class="carousel-control-prev">&lsaquo;</a> 
<a data-jcarousel-control="true" data-target="+=1" href="#" class="carousel-control-next">&rsaquo;</a> 
</div>

<div id="carousel-text"> 
  <h1>Sign up/Log in to Add Favorite Recipies!</h1>
  <button onclick="location.href='login.php'">Sign up/Log in</button>
</div>
</div>






<?php include_once("footer.html"); ?>

