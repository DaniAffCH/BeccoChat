<!DOCTYPE html>

<head>
<link rel="stylesheet" type="text/css" href="static/css/chat.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="//ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="static/js/chat.js"></script>
<?php
     require_once "inc/dailyDelete.php";
     session_start();
     if (!isset($_SESSION['auth'])) {
         header("location:index.php");
         die;
     }
     if ($_SERVER['REQUEST_METHOD'] === 'POST' and isset($_POST['nome'])){
          $_SESSION['name'] = strip_tags(stripslashes($_POST["nome"]));
     }
?>
</head>

<body>
     <div class="chatContainer" align="center">
          <div class="chatHeader">
               <h3>Benvenuto <?php echo($_SESSION['name']);?></h3>
          </div>
          <div class="chatMessages">
               <?php
                    require_once "inc/connection.php";
                    $db = new DB;
                    $query = "SELECT * FROM Logs ORDER BY ID";
                    $res = $db->select($query);
                    foreach ($res as $msg) {
                         echo(sprintf("<font style = 'color: #000000;'><li class='cm' align='left'><font style = 'color: #D9534F;'> %s </font></b> - %s </li></font>", ucwords($msg["Name"]), $msg["Message"]));
                    }
               ?>
          </div>
          <div class="chatBottom">
               <form action="" onsubmit="return false;" id="chatForm">
                    <input type="hidden" id="name" name="name" value="<?php echo($_SESSION['name']);?>">
                    <input type="text" name="msg" id="msg" placeholder="Inserisci il mesaggio">
                    <input type="submit" name="submit" value="Invio">
               </form>
               <form action="inc/delete.php" method="post">
                    <button name="delete" class="delete" onclick="deleteMyMessages()">Cancella i miei messaggi</button>
               </form>
          </div>
     </div>
</body>

</html>
