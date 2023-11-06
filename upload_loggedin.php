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
?>

<h1 id="hup">Upload a Recipe!!!</h1>
</div>



<div id="details">
  <h1>Recipe Details</h1>
  <form method="POST" action="upload_handler.php" enctype="multipart/form-data">
    
<?php
   if(isset($_SESSION['message'])) {
      echo "<div id='content'>";
      echo "<div class='" . $_SESSION['message_type'] . "' id='message'>" . $_SESSION['message'] . "</div>";
      unset($_SESSION['message']);
      unset($_SESSION['message_type']);
   }
?>
    <label for="title"><input type="text" id="title" name="title" placeholder="title"> title</label><br>

    <label>Select one option:</label><br>
    <label><input type="radio" name="checklist1" value="breakfast">breakfast</label><br>
    <label><input type="radio" name="checklist1" value="lunch">lunch</label><br>
    <label><input type="radio" name="checklist1" value="dinner">dinner</label><br>
    <label><input type="radio" name="checklist1" value="dessert">dessert</label><br>
    <label>Select one option:</label><br>
    <label><input type="radio" name="checklist2" value="easy">easy</label><br>
    <label><input type="radio" name="checklist2" value="intermediate">intermediate</label><br>
    <label><input type="radio" name="checklist2" value="hard">hard</label><br>

    <label for="ingredients"><input type="text" id="ingredients" name="ingredients" placeholder="ingredients"> add commma separated values</label><br>
    <label for="cooktime"><input type="text" id="cooktime" name="cooktime" placeholder="cook time"> cook time</label><br>
    <label for="servings"><input type="text" id="servings" name="servings" placeholder="servings"> # of servings</label><br>
    <label for="instructions"><input type="text" id="instructions" name="instructions" placeholder="instructions"> add commma separated steps</label><br>
    <label for="description"><input type="text" id="description" name="description" placeholder="description"> description</label><br>
    <label for="pic"><input type="file" id="pic" name="image" placeholder="upload a picture!">   PNG or JPEG</label><br>
    <input id="submit" type="submit">
  </form>
</div>




<?php include_once("footer.html"); ?>

