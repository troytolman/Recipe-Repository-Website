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

  $page = 'exp';
  require("nav_loggedin.php"); 
?>

<div id="explore"> 
  Explore Boise Chef Now!!!
</div>
<div id="search">
<form id="searchform" method="GET" action="explore_loggedin.php">
  <?php  
  if(isset($_SESSION['message'])) {
    echo "<div id='content'>";
    echo "<div class='" . $_SESSION['message_type'] . "' id='message'>" . $_SESSION['message'] . "</div>";
    unset($_SESSION['message']);
    unset($_SESSION['message_type']);
 }
  ?>
  <input type="text" name="titleSearch" placeholder="Search..">

  <label><input type="checkbox" name="meal[]" value="breakfast">breakfast</label><br>
  <label><input type="checkbox" name="meal[]" value="lunch">lunch</label><br>
  <label><input type="checkbox" name="meal[]" value="dinner">dinner</label><br>
  <label><input type="checkbox" name="meal[]" value="dessert">dessert</label><br>
  <label><input type="checkbox" name="difficulty[]" value="easy">easy</label><br>
  <label><input type="checkbox" name="difficulty[]" value="intermediate">intermediate</label><br>
  <label><input type="checkbox" name="difficulty[]" value="hard">hard</label><br>
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
        header('Location: explore_loggedin.php'); // Redirect back to the login page or show an error message
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
