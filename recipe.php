<?php
  $page = '';
  require_once("nav.php"); 
  require_once('Dao.php');
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
  <!-- <div id="step1">
    <h2>Step 1</h2>
    <p>Preheat the oven to 350°F.
      Grease a 12-cup Bundt pan liberally with butter or nonstick baking
      spray. Set it aside.</p>
  </div>
  <div id="step2">
    <h2>Step 2</h2>
    <p>Prepare the cinnamon sugar and biscuit dough:
      In a large bowl, whisk together the granulated sugar and cinnamon.
      Separate the biscuit dough and cut each biscuit into 6 evenly sized
      pieces.</p>
  </div>
  <div id="step3">
    <h2>Step 3</h2>
    <p>Coat the biscuit dough:
      Add the biscuit pieces to the bowl of cinnamon sugar, and use your hands to
      toss and evenly coat each piece with the cinnamon sugar. Transfer the
      coated dough and any extra cinnamon sugar into the prepared Bundt pan,
      and distribute them evenly in the pan.</p>
  </div> -->
</div>






<?php include_once("footer.html"); ?>

