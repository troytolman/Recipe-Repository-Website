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

  public function explore($titleSearch, $meals, $difficulties) {
    $conn = $this->getConnection();
    $searchRecipe =
        "SELECT * FROM recipes JOIN tags ON recipes.recipeID = tags.recipeIDtagged
        WHERE title LIKE :title";
    if (!empty($meals)) {
        $searchRecipe .= " AND meal IN (";
        if (is_array($meals)) {
          for ($i = 0; $i < count($meals); $i++) {
            if ($i == count($meals)-1) {
              $searchRecipe .= ":meal" . $i . ")";
            } else {
              $searchRecipe .= ":meal" . $i . ", ";
            }
          }
        } else {
          $searchRecipe .= ":meal)";
        }
    }
    //echo $searchRecipe;
    if (!empty($difficulties)) {
        $searchRecipe .= " AND difficulty IN (";
        
        if (is_array($difficulties)) {
          //echo print_r($difficulties);
          for ($i = 0; $i < count($difficulties); $i++) {
            if ($i == count($difficulties)-1) {
              $searchRecipe .= ":difficulty" . $i . ");";
            } else {
              $searchRecipe .= ":difficulty" . $i . ", ";
            }
          }
        } else {
          $searchRecipe .= ":difficulty);";
        }
    } else {
      $searchRecipe .= ";"; 
    }
     //echo $searchRecipe;
    // echo $meals;

    $q = $conn->prepare($searchRecipe);
    $q->bindParam(':title', $titleSearch);
    if (!empty($meals)) {
      if (is_array($meals)) {
        for ($i = 0; $i < count($meals); $i++) {
          $q->bindParam(':meal' . $i, $meals[$i]);
        }
      } else {
        $q->bindParam(':meal', $meals);
      } 
    }
  
    if (!empty($difficulties)) {
      if (is_array($difficulties)) {
        for ($i = 0; $i < count($difficulties); $i++) {
          $q->bindParam(':difficulty' . $i, $difficulties[$i]);
        }
      } else {
        $q->bindParam(':difficulty', $difficulties);
      }
    }
    $q->execute();
    $ret = $q->fetchAll(PDO::FETCH_ASSOC);
    // if (empty($ret)) {
    //   echo print_r($ret);
    // }
    
    return $ret;
  }

  public function addRecipe($title, $ingredients, $cooktime, $servings, $instructions, $target_file, $userID, $description, $tag1, $tag2) {
    $conn = $this->getConnection();
    $addRecipe =
        "INSERT INTO recipes (userID, title, ingredients, cook_time, serving_size, instructions, image_path, description)
         VALUES (:userID, :title, :ingredients, :cooktime, :servings, :instructions, :path, :description);";
    $q = $conn->prepare($addRecipe);
    $q->bindParam(":userID", $userID);
    $q->bindParam(":title", $title);
    $q->bindParam(":ingredients", $ingredients);
    $q->bindParam(":cooktime", $cooktime);
    $q->bindParam(":servings", $servings);
    $q->bindParam(":instructions", $instructions);
    $q->bindParam(":path", $target_file);
    $q->bindParam(":description", $description);
    $q->execute();
    $q = $conn->prepare("SELECT recipeID FROM recipes WHERE title = :title LIMIT 1;");
    $q->bindParam(":title", $title);
    $q->execute();
    $recipeID = $q->fetchColumn();
    $q = $conn->prepare("INSERT INTO tags (recipeIDtagged, meal, difficulty) VALUES (:recipeID, :tag1, :tag2);");
    $q->bindParam(":recipeID", $recipeID);
    $q->bindParam(":tag1", $tag1);
    $q->bindParam(":tag2", $tag2);
    $q->execute();
  }

  public function getRecipes() {
    $conn = $this->getConnection();
    $recipeQuery =
        "SELECT * FROM recipes LIMIT 6;";
    $q = $conn->prepare($recipeQuery);
    $q->execute();
    return $q->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getFavRecipes($userID) {
    $conn = $this->getConnection();
    $recipeQuery = "SELECT 
                      image_path,
                      recipes.recipeID as recipeID,
                      title,
                      description
                    FROM recipes JOIN favorites ON recipes.recipeID = favorites.recipeID
                    WHERE user_that_favorited_ID = :userID;";
    $q = $conn->prepare($recipeQuery);
    $q->bindParam(":userID", $userID);
    $q->execute();
    return $q->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getRecipe($recipeID) {
    $conn = $this->getConnection();
    $recipeQuery =
        "SELECT * FROM recipes WHERE recipeID = :recipeID;";
    $q = $conn->prepare($recipeQuery);
    $q->bindParam(":recipeID", $recipeID);
    $q->execute();
    return $q->fetchAll(PDO::FETCH_ASSOC);
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