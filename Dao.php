<?php

class Dao {

  private $host = "l6glqt8gsx37y4hs.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
  private $db = "e1kh0ddh49syn5j4";
  private $user = "krvu9t55m8wgwnpc";
  private $pass = "orf3fnxt4x8vdd65";

  public function getConnection () {
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

public function printStuff($something) {
    
    echo "<pre>" . $something . "</pre>";
 }
 

  public function authenticate ($username, $password) {
     // TODO make an actual table.
     return ($username == "conrad" && $password == 'abc123');
  }
} // end Dao