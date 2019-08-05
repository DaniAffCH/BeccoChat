<!DOCTYPE html>

<head>
<link rel="stylesheet" type="text/css" href="static/css/chat.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="//ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="static/js/chat.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script>

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
               <h3>Benvenuto <?php echo($_SESSION['name']);?></h3>
          </div>
          <div class="chatMessages">
               <?php
                    require_once "inc/connection.php";
                    require_once "inc/encryptDecrypt.php";
                    $db = new DB;
                    $query = "SELECT * FROM Logs ORDER BY ID";
                    $res = $db->select($query);
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
