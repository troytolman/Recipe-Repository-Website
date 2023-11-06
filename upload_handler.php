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

$imageName = basename($_FILES["image"]["name"]);

if (isset($imageName) && is_string($imageName) && !empty($imageName)) {
    
    //echo "The file $imageName has been uploaded.";
    
} else {
    // The image name is empty or not a string, indicating an issue with the uploaded file.
    $_SESSION['message'] = 'Invalid file name.';
    $_SESSION['message_type'] = 'sad';
    header('Location: upload_loggedin.php');
    exit;
}

$target_dir = "app/images/";
$target_file = $target_dir . $imageName;
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check if image file is a valid image
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check === false) {
        $_SESSION['message'] = 'File is not a valid image.';
        $_SESSION['message_type'] = 'sad';
        header('Location: upload_loggedin.php');
        exit;
    }
}

// Check if file already exists
if (file_exists($target_file)) {
    $_SESSION['message'] = 'Sorry, the file already exists.';
    $_SESSION['message_type'] = 'sad';
    header('Location: upload_loggedin.php');
    exit;
}

// Check file size (e.g., 500KB)
if ($_FILES["image"]["size"] > 500000) {
    $_SESSION['message'] = 'Sorry, your file is too large.';
    $_SESSION['message_type'] = 'sad';
    header('Location: upload_loggedin.php');
    exit;
}

// Allow certain file formats
$allowed_image_types = ["jpg", "jpeg", "png", "gif"];
if (!in_array($imageFileType, $allowed_image_types)) {
    $_SESSION['message'] = 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.';
    $_SESSION['message_type'] = 'sad';
    header('Location: upload_loggedin.php');
    exit;
}

if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
    echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";
    
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

    if (empty($title) || empty($ingredients) || empty($cooktime) || empty($servings) || empty($instructions) || empty($description)) {
        $_SESSION['message'] = 'One or more fields are missing.';
        $_SESSION['message_type'] = 'sad';
        header('Location: upload_loggedin.php');
        exit;
    } else {
        // Sanitize fields before using them in a database query
        $title = htmlspecialchars($title, ENT_QUOTES, 'UTF-8');
        $ingredients = htmlspecialchars($ingredients, ENT_QUOTES, 'UTF-8');
        $cooktime = htmlspecialchars($cooktime, ENT_QUOTES, 'UTF-8');
        $servings = htmlspecialchars($servings, ENT_QUOTES, 'UTF-8');
        $instructions = htmlspecialchars($instructions, ENT_QUOTES, 'UTF-8');
        $description = htmlspecialchars($description, ENT_QUOTES, 'UTF-8');
    }

    // Database interaction using prepared statements
    $dao = new Dao();
    $dao->addRecipe($title, $ingredients, $cooktime, $servings, $instructions, $target_file, $_SESSION['userID'], $description, $tag1, $tag2);
    $recipeID = $dao->getRecipeID($title, $_SESSION['userID']);
    header('Location: recipe.php?id=' . $recipeID);
    exit;
} else {
    $_SESSION['message'] = 'Sorry, there was an error uploading your file.';
    $_SESSION['message_type'] = 'sad';
    header('Location: upload_loggedin.php');
    exit;
}
