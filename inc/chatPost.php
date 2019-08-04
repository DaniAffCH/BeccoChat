<?php
     session_start();
     if (!isset($_SESSION['auth'])) {
         header("location:index.php");
         die;
     }
     require_once "connection.php";
     require_once "encryptDecrypt.php";
     $db = new DB;
     if ($_SERVER['REQUEST_METHOD'] === 'POST' and isset($_POST['text'])) {
          $msg = strip_tags(stripslashes($_POST["text"]));
          $data = [
               'name' => encrypt($_SESSION['name']),
               'msg' => encrypt($msg)
          ];
          $query = "INSERT INTO Logs (Name, Message) VALUES (:name, :msg)";
          $db->select($query, $data);
          echo(sprintf("<font style = 'color: #000000;'><li class='cm' align='left'><font style = 'color: #D9534F;'> %s </font></b> - %s </li></font>", ucwords($_SESSION['name']), $msg));
     }
?>
