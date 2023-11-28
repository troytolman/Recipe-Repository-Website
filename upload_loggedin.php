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
<script src="https://app.simplefileupload.com/buckets/a590653121989d772a74421ef6bf6185.js"></script>

<div class="details">
<h1 >Upload a Recipe</h1>
  <h2>Recipe Details</h2>
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

    <h4>Select one meal option:</h4>
    <label><input type="radio" name="checklist1" value="breakfast" <?php echo (isset($_SESSION['inputs']['checklist1']) && $_SESSION['inputs']['checklist1'] === 'breakfast') ? 'checked' : ''; ?>>breakfast</label><br>
    <label><input type="radio" name="checklist1" value="lunch" <?php echo (isset($_SESSION['inputs']['checklist1']) && $_SESSION['inputs']['checklist1'] === 'lunch') ? 'checked' : ''; ?>>lunch</label><br>
    <label><input type="radio" name="checklist1" value="dinner" <?php echo (isset($_SESSION['inputs']['checklist1']) && $_SESSION['inputs']['checklist1'] === 'dinner') ? 'checked' : ''; ?>>dinner</label><br>
    <label><input type="radio" name="checklist1" value="dessert" <?php echo (isset($_SESSION['inputs']['checklist1']) && $_SESSION['inputs']['checklist1'] === 'dessert') ? 'checked' : ''; ?>>dessert</label><br>
    <h4>Select one difficulty option:</h4>
    <label><input type="radio" name="checklist2" value="easy" <?php echo (isset($_SESSION['inputs']['checklist2']) && $_SESSION['inputs']['checklist2'] === 'easy') ? 'checked' : ''; ?>>easy</label><br>
    <label><input type="radio" name="checklist2" value="intermediate" <?php echo (isset($_SESSION['inputs']['checklist2']) && $_SESSION['inputs']['checklist2'] === 'intermediate') ? 'checked' : ''; ?>>intermediate</label><br>
    <label><input type="radio" name="checklist2" value="hard" <?php echo (isset($_SESSION['inputs']['checklist2']) && $_SESSION['inputs']['checklist2'] === 'hard') ? 'checked' : ''; ?>>hard</label><br>

    <label for="ingredients"><input class="textfields" type="text" id="ingredients" name="ingredients" value="<?php echo isset($_SESSION['inputs']['ingredients']) ? $_SESSION['inputs']['ingredients'] : '' ?>"> ingredients as commma separated values (example: 1 cup sugar, 3 eggs)</label><br>
    <label for="cooktime"><input class="textfields" type="text" id="cooktime" name="cooktime" value="<?php echo isset($_SESSION['inputs']['cooktime']) ? $_SESSION['inputs']['cooktime'] : '' ?>"> cook time</label><br>
    <label for="servings"><input class="textfields" type="text" id="servings" name="servings" value="<?php echo isset($_SESSION['inputs']['servings']) ? $_SESSION['inputs']['servings'] : '' ?>"> # of servings</label><br>
    <label for="instructions"><input class="textfields" type="text" id="instructions" name="instructions" value="<?php echo isset($_SESSION['inputs']['instructions']) ? $_SESSION['inputs']['instructions'] : '' ?>"> steps as commma separated values (example: whisk ingredients in medium bowl, bake at 400 for 40 minutes)</label><br>
    <label for="description"><input class="textfields" type="text" id="description" name="description" value="<?php echo isset($_SESSION['inputs']['description']) ? $_SESSION['inputs']['description'] : '' ?>"> description</label><br>
    <input id="uploader-preview-here-5424" class="simple-file-upload" type="hidden" data-maxFileSize="5" data-accepted="image/*" name="imageURL">   PNG or JPEG<br>
    <input id="submit" type="submit">
  </form>
  <?php unset($_SESSION['inputs']); ?>
</div>



<?php include_once("footer.html"); ?>

