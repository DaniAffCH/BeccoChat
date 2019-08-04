<?php
     session_start();
     if (!isset($_SESSION['auth'])) {
         header("location:index.php");
         die;
     }
     require_once "connection.php";
     require_once "encryptDecrypt.php";
     $db = new DB;
     $data = [
          'name' => encrypt($_SESSION['name'])
     ];
     $query = "DELETE FROM Logs WHERE Name = :name";
     $db->select($query, $data);
     header("location:../chat.php");
?>
