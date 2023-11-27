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

  $page = 'pop';
  require("nav_loggedin.php"); 
  require_once('Dao.php');
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

<div class="recipe-preview-container">
<?php 
  $dao = new Dao();
  $recipes = $dao->getRecipes();
  foreach ($recipes as $recipe) {
    echo '<div class="recipe-preview">';
    echo '<img src=' . $recipe['image_url'] . ' width="300" height="200">';
    echo '<h3><a href="recipe.php?id=' . $recipe['recipeID'] . '">' . $recipe['title'] . '</a></h3>';
    echo '<p>' . $recipe['description'] . '</p>';
    // Add more content here
    echo '</div>';
  }
?>
</div>


<?php include_once("footer.html"); ?>
