<?php
     session_start();
     if (!isset($_SESSION['auth'])) {
         header("location:index.php");
         die;
     }
     require_once "connection.php";
     $db = new DB;
     $query = "SELECT * FROM Logs ORDER BY ID";
     $res = $db->select($query);
     foreach ($res as $msg) {
          echo(sprintf("<font style = 'color: #000000;'><li class='cm' align='left'><font style = 'color: #D9534F;'> %s </font></b> - %s </li></font>", ucwords($msg["Name"]), $msg["Message"]));
     }
?>
