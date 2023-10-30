<?php

class Dao {

  private $host = "l6glqt8gsx37y4hs.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
  private $db = "e1kh0ddh49syn5j4";
  private $user = "krvu9t55m8wgwnpc";
  private $pass = "orf3fnxt4x8vdd65";

  private $userID;

  public function getConnection() {
    return
      new PDO("mysql:host={$this->host};dbname={$this->db}", $this->user,
          $this->pass);
  }

  public function addRecipe($title, $ingredients, $cooktime, $servings, $instructions, $target_file, $userID) {
    $conn = $this->getConnection();
    $addRecipe =
        "INSERT INTO recipes (userID, title, ingredients, cook_time, serving_size, instructions, image_path)
         VALUES (:userID, :title, :ingredients, :cooktime, :servings, :instructions, :path);";
    $q = $conn->prepare($addRecipe);
    $q->bindParam(":userID", $userID);
    $q->bindParam(":title", $title);
    $q->bindParam(":ingredients", $ingredients);
    $q->bindParam(":cooktime", $cooktime);
    $q->bindParam(":servings", $servings);
    $q->bindParam(":instructions", $instructions);
    $q->bindParam(":path", $target_file);
    return $q->execute();
  }

  public function createUser($email, $username, $password) {
    $conn = $this->getConnection();
    $addUser = "INSERT INTO users (user_email, user_name, user_password)
                VALUES (:email, :username, :password);";
    $q = $conn->prepare($addUser);
    $q->bindParam(":email", $email);
    $q->bindParam(":username", $username);
    $q->bindParam(":password", $password);
    $q->execute();
  }

  public function getUserID($username) {
    $conn = $this->getConnection();
    $select = "SELECT userID FROM users WHERE user_name = :username;";
    $q = $conn->prepare($select);
    $q->bindParam(":username", $username);
    $q->execute();
    return $q->fetchColumn();
  }
 

  public function authenticate($username, $password) {
    $conn = $this->getConnection();
    $select = "SELECT count(user_name) FROM users WHERE user_name = :username AND user_password = :password;";
    $q = $conn->prepare($select);
    $q->bindParam(":username", $username);
    $q->bindParam(":password", $password);
    $ret = $q->execute();
    if ($ret >= 1) {
      return true;
    } else {
      return false;
    }
  }
} // end Dao