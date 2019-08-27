<!DOCTYPE html>

<head>
<link rel="stylesheet" type="text/css" href="static/css/chat.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="//ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="static/js/chat.js"></script>
<script src="static/js/setOnline.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script>


<?php
     require_once "inc/connection.php";
     require_once "inc/dailyDelete.php";
     require_once "inc/encryptDecrypt.php";
     session_start();
     $db = new DB;
     if (!isset($_SESSION['auth'])) {
         header("location:index.php");
         die;
     }
     elseif ($_SERVER['REQUEST_METHOD'] === 'POST' and isset($_SESSION['name']) and isset($_POST['room'])){
          $_SESSION['room'] = $_POST["room"];
          $data = [
               'room' => $_POST["room"],
               'name' => encrypt($_SESSION['name'])
          ];
          $query = "UPDATE User SET RoomID = :room WHERE Name = :name";;
          $result = $db->select($query, $data);
     }
     if(!isset($_SESSION['name']) or !isset($_SESSION['room'])){
          header("location:home.php");
          die;
     }
?>

<script>
     $(window).on("load", function() {
          var loading = $(".loading");
          loading.delay(loading.attr("delay-hide")).slideUp();
          $(".chatMessages").stop().animate({ scrollTop: $(".chatMessages")[0].scrollHeight}, 1000);
     });
</script>
</head>

<body>
     <div class="loading" delay-hide="1000"></div>
     <div class="chatContainer" align="center">
          <div class="chatHeader">
               <h3>Benvenuto <?php echo($_SESSION['name']);?> in <?php
                    $data = [
                         "id" => $_SESSION['room']
                    ];
                    $query = "SELECT Name FROM Rooms WHERE ID = :id";
                    $result = $db->select($query, $data);
                    print_r($result[0]["Name"]);?></h3>
          </div>
          <div class="chatMessages">
               <?php
                    require_once "inc/connection.php";
                    require_once "inc/encryptDecrypt.php";
                    $db = new DB;
                    $data = [
                         'room' => $_SESSION['room']
                    ];
                    $query = "SELECT l.Message as Message, u.Name as Name, l.Timestamp as Timestamp FROM Logs as l INNER JOIN User as u ON l.UserID = u.ID WHERE l.RoomID = :room ORDER BY l.ID";
                    $res = $db->select($query, $data);
                    foreach ($res as $msg) {
                         echo(sprintf("<font style = 'color: #000000;'><li class='cm' align='left'><font style = 'color: #D9534F;'> %s </font></b> - %s </li></font>", ucwords(decrypt($msg["Name"])), decrypt($msg["Message"])));
                    }
               ?>
          </div>
          <div class="chatBottom">
               <form action="" onsubmit="return false;" id="chatForm">
                    <input type="hidden" id="name" name="name" value="<?php echo($_SESSION['name']);?>">
                    <input type="text" name="msg" id="msg" placeholder="Inserisci il mesaggio" autocomplete="off">
                    <input type="submit" name="submit" value="Invio">
               </form>
               <form action="inc/delete.php" method="post">
                    <button name="delete" class="delete" onclick="deleteMyMessages()">Cancella i miei messaggi</button>
               </form>
               <a href="home.php"><button class="btn"><i class="fa fa-home"></i> Home</button></a>
          </div>
     </div>
</body>

</html>
