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
  
  $page = 'up';
  require("nav_loggedin.php"); 
  require('Dao.php');
  $dao = new Dao();
  // $recipes = $dao->getRecipes(); still need to modify
  //     foreach ($recipes as $recipe) {
  //       echo "<tr><td>{$recipe['name']}</td><td>" . htmlentities($comment['comment']) . "</td><td>{$comment['date_entered']}</td></tr>";
  //     }
?>

<h1 id="hup">Upload a Recipe!!!</h1>
</div>



<div id="details">
  <h1>Recipe Details</h1>
  <form method="POST" action="upload_handler.php" enctype="multipart/form-data">
    <label for="title"><input type="text" id="title" name="title" value="title"> title</label><br>
    <label for="ingredients"><input type="text" id="ingredients" name="ingredients" value="ingredients"> add commma separated values</label><br>
    <label for="cooktime"><input type="text" id="cooktime" name="cooktime" value="cook time"> cook time</label><br>
    <label for="servings"><input type="text" id="servings" name="servings" value="servings"> # of servings</label><br>
    <label for="instructions"><input type="text" id="instructions" name="instructions" value="instructions"> add commma separated steps</label><br>
    <label for="pic"><input type="file" id="pic" name="image" value="upload a picture!">   PNG or JPEG</label><br>
    <input id="submit" type="submit">
  </form>
</div>




<?php include_once("footer.html"); ?>

