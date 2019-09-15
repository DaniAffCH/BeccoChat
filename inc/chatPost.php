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

          function getUserIdByName($name){
               $db = new DB;
               $data = [
                    'name' => encrypt($name)
               ];
               $query = "SELECT * FROM User WHERE Name = :name";
               $utente = $db->select($query, $data);
               return $utente[0]["ID"];
          }
          $msg = strip_tags(stripslashes($_POST["text"]));
          $data = [
               'usrID' => getUserIdByName($_SESSION['name']),
               'msg' => encrypt($msg),
               'room' => $_SESSION['room']
          ];
          $query = "INSERT INTO Logs (UserID, Message, RoomID) VALUES (:usrID, :msg, :room)";
          $db->select($query, $data);
          echo(sprintf("<font style = 'color: #000000;'><li class='cm' align='left'><font style = 'color: #D9534F;'> %s </font></b> - %s </li></font>", ucwords($_SESSION['name']), $msg));
     }
?>
