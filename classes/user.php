<?php
require_once "database.php";

class User extends Database {
   public function createUser($firstName, $lastName, $username, $password, $origin){
      $sql = "INSERT INTO users(first_name, last_name, username, `password`) VALUES ('$firstName', '$lastName', '$username', '$password')";

      if ($this->conn->query($sql)) {
         if($origin == "register"){
            header("location: ../views");
            exit;
         } else {
            header("location: ../views/dashboard.php");
         }
      } else {
         die("Error creating user: " . $this->conn->error);
      }
   }

   public function login($username, $password){
      $error = "The username or password you entered is incorrect.";
      $sql = "SELECT * FROM users WHERE username = '$username'";

      $result = $this->conn->query($sql);
      if($result->num_rows == 1){
         $userDetails = $result->fetch_assoc();
         if(password_verify($password, $userDetails['password'])){
            session_start();

            $_SESSION['id'] = $userDetails['id'];
            $_SESSION['username'] = $userDetails['username'];
            
            header("location: ../views/dashboard.php");
            exit;
         } else {
            echo $error;
         }
      } else {
         echo $error;
      }
   }

   public function getUsers($userID){
      $sql = "SELECT * FROM users WHERE id != $userID";

      if($result = $this->conn->query($sql)){
         return $result;
      } else {
         die("Error retrieving users: " . $this->conn->error);
      }
   }

   public function getUser($userID){
      $sql = "SELECT * FROM users WHERE id = $userID";

      if($result = $this->conn->query($sql)){
         return $result->fetch_assoc();
      } else {
         die("Error retrieving user: " . $this->conn->error);
      }
   }

   public function updateUser($userID, $firstName, $lastName, $username){
      $sql = "UPDATE users SET first_name = '$firstName', last_name = '$lastName', username = '$username' WHERE id = $userID";

      if($this->conn->query($sql)){
         header("location: ../views/dashboard.php");
         exit;
      } else {
         die("Error updating user: " . $this->conn->error);
      }
   }

   public function deleteUser($userID){
      $sql = "DELETE FROM users WHERE id = $userID";

      if($this->conn->query($sql)){
         header("location: ../views/dashboard.php");
      } else {
         die("Error deleting user: " . $this->conn->error);
      }
   }
}