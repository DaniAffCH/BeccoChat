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
          'room' => $_SESSION['room']
     ];
     $query = "SELECT l.Message as Message, u.Name as Name, l.Timestamp as Timestamp FROM Logs as l INNER JOIN User as u ON l.UserID = u.ID WHERE l.RoomID = :room ORDER BY l.ID";
     $res = $db->select($query, $data);
     $counter = 0;
     foreach ($res as $msg) {

          echo(sprintf("<li class='cm' align='left'><font style = 'color: #D9534F;'> %s </font><font style = 'color: #000000;'> - %s </font><small><font style = 'float:right'> %s </font></small></li>", ucwords(decrypt($msg["Name"])), decrypt($msg["Message"]), substr($msg["Timestamp"],11,5)));
          $counter++;
     }
     if($counter-$_SESSION['nMsg'] > 0){
          echo ('<script>$(".chatMessages").stop().animate({ scrollTop: $(".chatMessages")[0].scrollHeight}, 1000);</script>');
     }
     $_SESSION['nMsg']=$counter
?>
