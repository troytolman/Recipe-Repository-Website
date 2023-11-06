<?php
require_once 'Dao.php';
session_start();

if(!isset($_SESSION['authenticated'])) {
  header('Location: login.php');
  exit; 
}
if(isset($_SESSION['authenticated']) && !$_SESSION['authenticated']) {
  header('Location: login.php');
  exit; 
}

$target_dir = "images/";
$target_file = $target_dir . basename($_FILES["image"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["image"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size < 500KB
if ($_FILES["image"]["size"] > 500000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["image"]["name"])). " has been uploaded.";
    $title = trim($_POST['title']);
    $ingredients = trim($_POST['ingredients']);
    $cooktime = trim($_POST['cooktime']);
    $servings = trim($_POST['servings']);
    $instructions = trim($_POST['instructions']);
    $description = trim($_POST['description']);
    $tag1 = $_POST['checklist1'];
    $tag2 = $_POST['checklist2']; 
    if (empty($title) || empty($ingredients) || empty($cooktime) || empty($servings) || empty($instructions) || empty($description)) {
      $_SESSION['message'] = 'One or more fields are missing.';
      $_SESSION['message_type'] = "sad";
      header('Location: upload_loggedin.php'); // Redirect back to the login page or show an error message
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
    // $target_file for image file path
    $dao = new Dao();
    $dao->addRecipe($title, $ingredients, $cooktime, $servings, $instructions, $target_file, $_SESSION['userID'], $description, $tag1, $tag2);
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}



// if ($success) {              probably just take to recipe page
//     header("Location")
// }


?>