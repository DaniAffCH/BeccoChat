<?php
     session_start();

     function getUserIdByName($name){
          $db = new DB;
          $data = [
               'name' => encrypt($name)
          ];
          $query = "SELECT * FROM User WHERE Name = :name";
          $utente = $db->select($query, $data);
          return $utente[0]["ID"];
     }

     if (!isset($_SESSION['auth'])) {
         header("location:index.php");
         die;
     }
     require_once "connection.php";
     require_once "encryptDecrypt.php";
     $db = new DB;
     $data = [
          'ID' => getUserIdByName($_SESSION['name']),
          'room' => $_SESSION['room']
     ];
     $query = "DELETE FROM Logs WHERE UserID = :ID AND RoomID = :room";
     $db->select($query, $data);
     header("location:../chat.php");
?>
