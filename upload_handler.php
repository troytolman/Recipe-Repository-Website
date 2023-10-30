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

// Check file size
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
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}

require_once 'Dao.php';
$title = trim($_POST['title']);
$ingredients = trim($_POST['ingredients']);
$cooktime = trim($_POST['cooktime']);
$servings = trim($_POST['servings']);
$instructions = trim($_POST['instructions']);
// $target_file for image file path

$dao = new Dao();

$success = $dao->addRecipe($title, $ingredients, $cooktime, $servings, $instructions, $target_file, $_SESSION['userID']);

// if ($success) {              probably just take to recipe page
//     header("Location")
// }


?>