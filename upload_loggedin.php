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
    <label><input type="text" id="title" name="title" value="<?php echo isset($_SESSION['inputs']['title']) ? $_SESSION['inputs']['title'] : '' ?>"> title</label><br>

    <label>Select one meal option:</label><br>
    <label><input type="radio" name="checklist1" value="breakfast" <?php echo (isset($_SESSION['inputs']['checklist1']) && $_SESSION['inputs']['checklist1'] === 'breakfast') ? 'checked' : ''; ?>>breakfast</label><br>
    <label><input type="radio" name="checklist1" value="lunch" <?php echo (isset($_SESSION['inputs']['checklist1']) && $_SESSION['inputs']['checklist1'] === 'lunch') ? 'checked' : ''; ?>>lunch</label><br>
    <label><input type="radio" name="checklist1" value="dinner" <?php echo (isset($_SESSION['inputs']['checklist1']) && $_SESSION['inputs']['checklist1'] === 'dinner') ? 'checked' : ''; ?>>dinner</label><br>
    <label><input type="radio" name="checklist1" value="dessert" <?php echo (isset($_SESSION['inputs']['checklist1']) && $_SESSION['inputs']['checklist1'] === 'dessert') ? 'checked' : ''; ?>>dessert</label><br>
    <label>Select one difficulty option:</label><br>
    <label><input type="radio" name="checklist2" value="easy" <?php echo (isset($_SESSION['inputs']['checklist2']) && $_SESSION['inputs']['checklist2'] === 'easy') ? 'checked' : ''; ?>>easy</label><br>
    <label><input type="radio" name="checklist2" value="intermediate" <?php echo (isset($_SESSION['inputs']['checklist2']) && $_SESSION['inputs']['checklist2'] === 'intermediate') ? 'checked' : ''; ?>>intermediate</label><br>
    <label><input type="radio" name="checklist2" value="hard" <?php echo (isset($_SESSION['inputs']['checklist2']) && $_SESSION['inputs']['checklist2'] === 'hard') ? 'checked' : ''; ?>>hard</label><br>

    <label for="ingredients"><input type="text" id="ingredients" name="ingredients" value="<?php echo isset($_SESSION['inputs']['ingredients']) ? $_SESSION['inputs']['ingredients'] : '' ?>"> add commma separated values</label><br>
    <label for="cooktime"><input type="text" id="cooktime" name="cooktime" value="<?php echo isset($_SESSION['inputs']['cooktime']) ? $_SESSION['inputs']['cooktime'] : '' ?>"> cook time</label><br>
    <label for="servings"><input type="text" id="servings" name="servings" value="<?php echo isset($_SESSION['inputs']['servings']) ? $_SESSION['inputs']['servings'] : '' ?>"> # of servings</label><br>
    <label for="instructions"><input type="text" id="instructions" name="instructions" value="<?php echo isset($_SESSION['inputs']['instructions']) ? $_SESSION['inputs']['instructions'] : '' ?>"> add commma separated steps</label><br>
    <label for="description"><input type="text" id="description" name="description" value="<?php echo isset($_SESSION['inputs']['description']) ? $_SESSION['inputs']['description'] : '' ?>"> description</label><br>
    <label for="pic"><input type="file" id="pic" name="image" class="simple-file-upload" value="<?php echo isset($_SESSION['inputs']['image']) ? $_SESSION['inputs']['image'] : '' ?>">   PNG or JPEG</label><br>
    <input id="submit" type="submit">
  </form>
  <?php unset($_SESSION['inputs']); ?>
</div>




<?php include_once("footer.html"); ?>

