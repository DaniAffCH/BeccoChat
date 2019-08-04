<?php
     require_once "connection.php";
     $db = new DB;
     $data = [

     ];
     $datetime = new DateTime('tomorrow');
     $expire = $datetime->format('Y-m-d');
     $expire .= " 04:20:00";
     $data = [
          "expire" => $expire
     ];
     $query = "DELETE FROM Logs WHERE Timestamp > :expire";
     $db->select($query, $data);
?>
