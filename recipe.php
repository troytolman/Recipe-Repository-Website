<?php
  $page = '';
  require_once('Dao.php');
  session_start();

  if(!isset($_SESSION['authenticated'])) {
    require("nav.php"); 
  }
  if(isset($_SESSION['authenticated']) && $_SESSION['authenticated']) {
    require("nav_loggedin.php"); 
  }

  $recipeID = $_GET['id'];
  $dao = new Dao();
  $recipe = $dao->getRecipe($recipeID);
  $recipe = $recipe[0];
?>

<div class="title">
  <?php echo '<h1>' . $recipe['title'] . '</h1>' ?>
  <button id="titlebutton">Add to Favorites</button>
  <ul>
    <li>breakfast</li>
    <li>easy</li>
  </ul>
</div>

<div class="recipedesc">
  <h2>Recipe Description</h2>
  <?php echo "<p>" . $recipe['description'] . "</p>"; 
  echo '<img src=' . $recipe['image_path'] . ' >';
  ?>
</div>

<div class="ingredients">
<?php echo '<h2>' . $recipe['title'] . '</h2>' ?>
    <div class="times">
      <?php echo '<span>Cook Time: ' . $recipe['cook_time'] . ' min</span>'; 
        echo '<span>Servings: ' . $recipe['serving_size'] . '</span>'
      ?>
    </div>
    <hr>
    <div>
      <h2 id="ingredientstitle">Ingredients</h2>
      <ul>
        <?php 
          $ingredients = explode(",", $recipe['ingredients']);
          foreach ($ingredients as $in) {
            echo '<li>' . $in . '</li>';
          }
        ?>
      </ul>
    </div>
</div>

<div class="methods">
  <h2>Method:</h2>
  <?php 
  $steps = explode(",", $recipe['instructions']);
  $i = 1;
  foreach ($steps as $step) {
    echo '<div id="step"><h2>Step ' .  $i . '</h2><p>' . $step . '</p></div>';
    $i++;
  }
?>
  
</div>






<?php include_once("footer.html"); ?>

