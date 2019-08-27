<?php
require_once "connection.php";
$db = new DB;
$query = "SELECT * FROM Rooms WHERE 1";
$result = $db->select($query);
$output = [];
foreach ($result as $room) {
     $onlineUsers = 0;
     $data = [
          "RoomID" => $room["ID"]
     ];

     $query = "SELECT DISTINCT (Name), LastActivity FROM User WHERE RoomID = :RoomID";

     $result = $db->select($query, $data);

     foreach ($result as $online) {
          $dateTime = new DateTime();
          $dateTime->modify('-4 seconds');
          if($online["LastActivity"] > $dateTime->format('Y-m-d H:i:s')){
               $onlineUsers++;
          }
     }
     echo($room["ID"]."-".$onlineUsers);
     echo("/");
}
?>
