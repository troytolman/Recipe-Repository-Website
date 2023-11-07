<?php
require_once 'Dao.php';
session_start();

$_SESSION['inputs'] = $_POST;

if(!isset($_SESSION['authenticated'])) {
  header('Location: login.php');
  exit; 
}
if(isset($_SESSION['authenticated']) && !$_SESSION['authenticated']) {
  header('Location: login.php');
  exit; 
}


$imagefileURL = $_POST['imageURL'];
$pattern = '/^https:\/\/cdn-32id4co7\./';

if (preg_match($pattern, $imagefileURL)) {
    // echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";
    
    $title = trim($_POST['title']);
    $ingredients = trim($_POST['ingredients']);
    $cooktime = trim($_POST['cooktime']);
    $servings = trim($_POST['servings']);
    $instructions = trim($_POST['instructions']);
    $description = trim($_POST['description']);
    $tag1 = $_POST['checklist1'];
    $tag2 = $_POST['checklist2'];
    if (!in_array($tag1, ["breakfast", "lunch", "dinner", "dessert"]) || !in_array($tag2, ["easy", "intermediate", "hard"])) {
      if (!empty($tag1) && !empty($tag2)) {
        $_SESSION['message'] = 'The chosen tags are not valid.';
        $_SESSION['message_type'] = 'sad';
        header('Location: upload_loggedin.php');
        exit;
      }
  }

    // Additional validation for other fields (e.g., numeric values, date formats, etc.) can be added here.

    if (empty($title) || empty($ingredients) || empty($cooktime) || empty($servings) || empty($instructions) || empty($description) || empty($imagefileURL)) {
        $_SESSION['message'] = 'One or more fields are missing.';
        $_SESSION['message_type'] = 'sad';
        header('Location: upload_loggedin.php');
        exit;
    } 
        // Sanitize fields before using them in a database query
    $title = htmlspecialchars($title, ENT_QUOTES, 'UTF-8');
    $ingredients = htmlspecialchars($ingredients, ENT_QUOTES, 'UTF-8');
    $cooktime = htmlspecialchars($cooktime, ENT_QUOTES, 'UTF-8');
    $servings = htmlspecialchars($servings, ENT_QUOTES, 'UTF-8');
    $instructions = htmlspecialchars($instructions, ENT_QUOTES, 'UTF-8');
    $description = htmlspecialchars($description, ENT_QUOTES, 'UTF-8');
    
    $dao = new Dao();
    $dao->addRecipe($title, $ingredients, $cooktime, $servings, $instructions, $imagefileURL, $_SESSION['userID'], $description, $tag1, $tag2);
    $recipeID = $dao->getRecipeID($title, $_SESSION['userID']);
    header('Location: recipe.php?id=' . $recipeID);
    exit;
} else {
    $_SESSION['message'] = 'Sorry, there was an error uploading your file.';
    $_SESSION['message_type'] = 'sad';
    header('Location: upload_loggedin.php');
    exit;
}
