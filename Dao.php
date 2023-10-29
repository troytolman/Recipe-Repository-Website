<?php

class Dao {

  private $host = "l6glqt8gsx37y4hs.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
  private $db = "e1kh0ddh49syn5j4";
  private $user = "krvu9t55m8wgwnpc";
  private $pass = "orf3fnxt4x8vdd65";

  public function getConnection() {
    return
      new PDO("mysql:host={$this->host};dbname={$this->db}", $this->user,
          $this->pass);
  }

//   public function deleteComment ($id) {
//     $conn = $this->getConnection();
//     $deleteComment =
//         "DELETE FROM comments
//         WHERE id = :id";
//     $q = $conn->prepare($deleteComment);
//     $q->bindParam(":id", $id);
//     $q->execute();
//   }

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