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

  $page = 'fav';
  require("nav_loggedin.php"); 
  require_once('Dao.php');
?>

<div id="low">
  <img src="junk.svg" alt="" width="400" height="400" id="junk">
<h1 class="lowclass">Recipe Name from Popular Recipes</h1>
<p class="lowclass">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy.</p>
<button id="explorebutton"> <a href="explore_loggedin.php">Explore Recipes!</button>
</div>

</div>



<div class="recipe-preview-container">
<?php 
  $dao = new Dao();
  $recipes = $dao->getFavRecipes($_SESSION['userID']);
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



<div id="footer">
  <img src="logo.jpg" alt="" width="80" height="80" class="foot">
  <h1 class="foot" id="h1foot">Boise Chef</h1>
  <p class="foot" id="pfoot">(c) 2023 Boise Chef</p>
</div>

</body>
</html>

