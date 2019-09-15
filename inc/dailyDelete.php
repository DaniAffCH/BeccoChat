<?php
     require_once "connection.php";
     $db = new DB;
     $expire = "04:20:00";
     $data = [
          "expire" => $expire
     ];
     $query = "DELETE FROM Logs WHERE 'LastActivity' < CURRENT_DATE() AND CURRENT_TIME( ) > :expire";
     $db->select($query, $data);
     $query = "DELETE FROM User WHERE 'LastActivity' < CURRENT_DATE() AND CURRENT_TIME( ) > :expire";
     $db->select($query, $data);
?>
