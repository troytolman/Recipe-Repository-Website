<?php
  $page = 'exp';
  require("nav.php"); 
?>

<div id="explore"> 
  Explore Boise Chef
</div>
<div id="search">
<form id="searchform" method="GET" action="explore.php">
  <?php  
  if(isset($_SESSION['message'])) {
    echo "<div id='content'>";
    echo "<div class='" . $_SESSION['message_type'] . "' id='message'>" . $_SESSION['message'] . "</div>";
    unset($_SESSION['message']);
    unset($_SESSION['message_type']);
 }
  ?>
  <label for="titleSearch"><input type="text" id="titleSearch" name="titleSearch" placeholder="Search.."></label><br>
  <div class="checkboxes">
  <label for="breakfast"><input type="checkbox" id="breakfast" name="meal[]" value="breakfast">breakfast</label><br>
  <label for="lunch"><input type="checkbox" id="lunch" name="meal[]" value="lunch">lunch</label><br>
  <label for="dinner"><input type="checkbox" id="dinner" name="meal[]" value="dinner">dinner</label><br>
  <label for="dessert"><input type="checkbox" id="dessert" name="meal[]" value="dessert">dessert</label><br>
  <label for="easy"><input type="checkbox" id="easy" name="difficulty[]" value="easy">easy</label><br>
  <label for="intermediate"><input type="checkbox" id="intermediate" name="difficulty[]" value="intermediate">intermediate</label><br>
  <label for="hard"><input type="checkbox" id="hard" name="difficulty[]" value="hard">hard</label><br>
</div>
<input id="submit" type="submit">
</form>
</div>

</div>

<?php
require_once 'Dao.php';

$dao = new Dao();


//if ($_SERVER["REQUEST_METHOD"] === "GET") {
  if (isset($_GET['titleSearch']) || isset($_GET['meal']) || isset($_GET['difficulty'])) {
    $titleSearch = trim($_GET["titleSearch"]);

    if (empty($titleSearch)) {
      $titleSearch = "%";
    } else {
      $titleSearch = htmlspecialchars($titleSearch, ENT_QUOTES, 'UTF-8');
      $pattern = "/^[a-zA-Z0-9\s\-]+$/";

      if (!preg_match($pattern, $titleSearch)) {
        $_SESSION['message'] = 'Invalid title, try again';
        $_SESSION['message_type'] = "sad";
        header('Location: explore.php'); // Redirect back to the login page or show an error message
        exit;
      } 
    }
    $meals = NULL;
    $difficulties = NULL;
    if (isset($_GET["meal"]) && array_intersect($_GET["meal"], ["breakfast", "lunch", "dinner", "dessert"])) {
      $meals = $_GET["meal"]; 
    } else {
      $meals = [];
    }

    if (isset($_GET["difficulty"]) && array_intersect($_GET["difficulty"], ["easy", "intermediate", "hard"])) {
      $difficulties = $_GET["difficulty"];
    } else {
      $difficulties = [];
    }
   
    $recipes = $dao->explore($titleSearch, $meals, $difficulties);

    // TODO: add message if nothing was matched

    echo '<div class="recipe-grid">';
    foreach ($recipes as $recipe) {
      echo '<div class="recipe-card">';
      echo '<img src="' . $recipe['image_url'] . '" alt="' . $recipe['title'] . '">';
      echo '<h3><a href="recipe.php?id=' . $recipe['recipeID'] . '">' . $recipe['title'] . '</a></h3>';
      echo '<p>' . $recipe['description'] . '</p>';
      echo '</div>';
    }
    echo '</div>';
    
  }
  

include_once("footer.html"); 

