<?php
  $page = 'up';
  require("nav.php"); 
  require_once 'Dao.php';
  $dao = new Dao();
  $something = "stuff"; // Define the $something variable
  $dao->printStuff($something); 
  // $recipes = $dao->getRecipes(); still need to modify
  //     foreach ($recipes as $recipe) {
  //       echo "<tr><td>{$recipe['name']}</td><td>" . htmlentities($comment['comment']) . "</td><td>{$comment['date_entered']}</td></tr>";
  //     }
?>

<h1 id="hup">Upload a Recipe!!!</h1>
</div>



<div id="details">
  <h1>Recipe Details</h1>
  <form action="POST">
    <label for="title"><input type="text" id="title" name="recipedetails" value="title"> title</label><br>
    <label for="servings"><input type="text" id="servings" name="recipedetails" value="servings"> # of servings</label><br>
    <label for="ingredients"><input type="text" id="ingredients" name="recipedetails" value="ingredients"> add commma separated values</label><br>
    <label for="pic"><input type="button" id="pic" name="recipedetails" value="upload a picture!">   PNG or JPEG</label><br>
  </form>
  <button id="submit"> Submit your recipe!</button>
</div>




<?php include_once("footer.html"); ?>

