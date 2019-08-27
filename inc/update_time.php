<?php
     if($_SERVER['REQUEST_METHOD'] === 'POST' and isset($_POST['action']) and $_POST['action'] == "update_time"){
          require_once "connection.php";
          require_once "encryptDecrypt.php";
          session_start();
          $db = new DB;
          $data = [
               'name' => encrypt($_SESSION['name']),
               'activity' => date("Y-m-d H:i:s", strtotime(date("h:i:sa")))
          ];
          $query = "UPDATE User SET LastActivity = :activity WHERE Name = :name";
          $db->select($query, $data);
     }
?>
